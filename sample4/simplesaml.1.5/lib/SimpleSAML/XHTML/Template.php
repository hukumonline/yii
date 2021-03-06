<?php

/**
 * A minimalistic XHTML PHP based template system implemented for simpleSAMLphp.
 *
 * @author Andreas Åkre Solberg, UNINETT AS. <andreas.solberg@uninett.no>
 * @package simpleSAMLphp
 * @version $Id: Template.php 1878 2009-10-19 12:57:58Z olavmrk $
 */
class SimpleSAML_XHTML_Template {

	/**
	 * This is the default language map. It is used to map languages codes from the user agent to
	 * other language codes.
	 */
	private static $defaultLanguageMap = array('nb' => 'no');


	private $configuration = null;
	private $template = 'default.php';
	private $language = null;
	
	private $langtext = array();
	
	public $data = null;


	/**
	 * Associative array of dictionaries.
	 */
	private $dictionaries = array();


	/**
	 * The default dictionary.
	 */
	private $defaultDictionary = NULL;


	/**
	 * Constructor
	 *
	 * @param $configuration   Configuration object
	 * @param $template        Which template file to load
	 * @param $defaultDictionary  The default dictionary where tags will come from.
	 */
	function __construct(SimpleSAML_Configuration $configuration, $template, $defaultDictionary = NULL) {
		$this->configuration = $configuration;
		$this->template = $template;
		
		$this->data['baseurlpath'] = $this->configuration->getBaseURL();
		
		if (isset($_GET['language'])) {
			$this->setLanguage($_GET['language']);
		}

		if($defaultDictionary !== NULL && substr($defaultDictionary, -4) === '.php') {
			/* For backwards compatibility - print warning. */
			$backtrace = debug_backtrace();
			$where = $backtrace[0]['file'] . ':' . $backtrace[0]['line'];
			SimpleSAML_Logger::warning('Deprecated use of new SimpleSAML_Template(...) at ' . $where .
				'. The last parameter is now a dictionary name, which should not end in ".php".');

			$this->defaultDictionary = substr($defaultDictionary, 0, -4);
		} else {
			$this->defaultDictionary = $defaultDictionary;
		}
	}
	
	/**
	 * setLanguage() will set a cookie for the user's browser to remember what language 
	 * was selected
	 * 
	 * @param $language    Language code for the language to set.
	 */
	public function setLanguage($language) {
		$this->language = $language;
		// setcookie ( string $name [, string $value [, int $expire [, string $path [, string $domain [, bool $secure [, bool $httponly ]]]]]] )
		// time()+60*60*24*900 expires 900 days from now.
		if (!headers_sent()) {
			setcookie('language', $language, time()+60*60*24*900, '/');
		}
	}

	/**
	 * getLanguage() will return the language selected by the user, or the default language
	 * This function first looks for a cached language code, 
	 * then checks for a language cookie,
	 * then it tries to calculate the preferred language from HTTP headers.
	 * Last it returns the default language.
	 */	
	public function getLanguage($checkHTTP = TRUE, $defaultFallback = TRUE) {
		
		// Language is set in object
		if (isset($this->language)) {
			return $this->language;
		}

		// Language is provided in a stored COOKIE
		if (isset($_COOKIE['language'])) {
			$this->language = $_COOKIE['language'];
			return $this->language;
		}
		
		if ($checkHTTP) {
			/* Check if we can find a good language from the Accept-Language http header. */
			$httpLanguage = $this->getHTTPLanguage();
			if ($httpLanguage !== NULL) {
				return $httpLanguage;
			}
		}

		// Language is not set, and we get the default language from the configuration.
		if ($defaultFallback) 
			return $this->getDefaultLanguage();
			
		return NULL;
	}


	/**
	 * This function gets the prefered language for the user based on the Accept-Language http header.
	 *
	 * @return The prefered language based on the Accept-Language http header, or NULL if none of the
	 *         languages in the header were available.
	 */
	private function getHTTPLanguage() {
		$availableLanguages = $this->configuration->getArray('language.available', array('en'));
		$languageScore = SimpleSAML_Utilities::getAcceptLanguage();

		/* For now we only use the default language map. We may use a configurable language map
		 * in the future.
		 */
		$languageMap = self::$defaultLanguageMap;

		/* Find the available language with the best score. */
		$bestLanguage = NULL;
		$bestScore = -1.0;

		foreach($languageScore as $language => $score) {

			/* Apply the language map to the language code. */
			if(array_key_exists($language, $languageMap)) {
				$language = $languageMap[$language];
			}

			if(!in_array($language, $availableLanguages, TRUE)) {
				/* Skip this language - we don't have it. */
				continue;
			}

			/* Some user agents use very limited precicion of the quality value, but order the
			 * elements in descending order. Therefore we rely on the order of the output from
			 * getAcceptLanguage() matching the order of the languages in the header when two
			 * languages have the same quality.
			 */
			if($score > $bestScore) {
				$bestLanguage = $language;
				$bestScore = $score;
			}
		}

		return $bestLanguage;
	}

	/**
	 * Returns the language base (from configuration)
	 */
	private function getBaseLanguage() {
		return 'en';
	}
	
	/**
	 * Returns the language default (from configuration)
	 */
	private function getDefaultLanguage() {
		return $this->configuration->getString('language.default', 'en');
	}

	/**
	 * Returns a list of all available languages.
	 */
	private function getLanguageList() {
		$availableLanguages = $this->configuration->getArray('language.available', array('en'));
		$thisLang = $this->getLanguage();
		$lang = array();
		foreach ($availableLanguages AS $nl) {
			$lang[$nl] = ($nl == $thisLang);
		}
		return $lang;
	}

	/**
	 * Includs a file relative to the template base directory.
	 * This function can be used to include headers and footers etc.
	 *
	 */	
	private function includeAtTemplateBase($file) {
		$data = $this->data;

		$filename = $this->findTemplatePath($file);
		
		include($filename);
	}


	/**
	 * Retrieve a dictionary.
	 *
	 * This function retrieves a dictionary with the given name.
	 *
	 * @param $name  The name of the dictionary, as the filename in the dictionary directory,
	 *               without the '.php'-ending.
	 * @return  An associative array with the dictionary.
	 */
	private function getDictionary($name) {
		assert('is_string($name)');

		if(!array_key_exists($name, $this->dictionaries)) {
			$sepPos = strpos($name, ':');
			if($sepPos !== FALSE) {
				$module = substr($name, 0, $sepPos);
				$fileName = substr($name, $sepPos + 1);
				$dictDir = SimpleSAML_Module::getModuleDir($module) . '/dictionaries/';
			} else {
				$dictDir = $this->configuration->getPathValue('dictionarydir', 'dictionaries/');
				$fileName = $name;
			}
			$this->dictionaries[$name] = $this->readDictionaryFile($dictDir . $fileName . '.php');
		}

		return $this->dictionaries[$name];
	}


	/**
	 * Retrieve a tag.
	 *
	 * This function retrieves a tag as an array with language => string mappings.
	 *
	 * @param $tag  The tag name. The tag name can also be on the form '{<dictionary>:<tag>}', to retrieve
	 *              a tag from the specific dictionary.
	 * @return As associative array with language => string mappings, or NULL if the tag wasn't found.
	 */
	public function getTag($tag) {
		assert('is_string($tag)');

		/* First check translations loaded by the includeInlineTranslation and includeLanguageFile methods. */
		if(array_key_exists($tag, $this->langtext)) {
			return $this->langtext[$tag];
		}

		/* Check whether we should use the default dictionary or a dictionary specified in the tag. */
		if(substr($tag, 0, 1) === '{' && preg_match('/^{((?:\w+:)?\w+?):(.*)}$/', $tag, $matches)) {
			$dictionary = $matches[1];
			$tag = $matches[2];
		} else {
			$dictionary = $this->defaultDictionary;
			if($dictionary === NULL) {
				/* We don't have any dictionary to load the tag from. */
				return NULL;
			}
		}

		$dictionary = $this->getDictionary($dictionary);
		if(!array_key_exists($tag, $dictionary)) {
			return NULL;
		}

		return $dictionary[$tag];
	}


	/**
	 * Retrieve the preferred translation of a given text.
	 *
	 * @param $translations  The translations, as an associative array with language => text mappings.
	 * @return The preferred translation.
	 */
	public function getTranslation($translations) {
		assert('is_array($translations)');

		/* Look up translation of tag in the selected language. */
		$selected_language = $this->getLanguage();
		if (array_key_exists($selected_language, $translations)) {
			return $translations[$selected_language];
		}

		/* Look up translation of tag in the default language. */
		$default_language = $this->getDefaultLanguage();
		if(array_key_exists($default_language, $translations)) {
			return $translations[$default_language];
		}

		/* Look up translation of tag in the base language. */
		$base_language = $this->getBaseLanguage();
		if(array_key_exists($base_language, $translations)) {
			return $translations[$base_language];
		}

		/* Pick the first translation available. */
		if(count($translations) > 0) {
			$languages = array_keys($translations);
			return $translations[$languages[0]];
		}

		/* We don't have anything to return. */
		throw new Exception('Nothing to return from translation.');
	}


	/**
	 * Translate a tag into the current language, with a fallback to english.
	 *
	 * This function is used to look up a translation tag in dictionaries, and return the
	 * translation into the current language. If no translation into the current language can be
	 * found, english will be tried, and if that fails, placeholder text will be returned.
	 *
	 * An array can be passed as the tag. In that case, the array will be assumed to be on the
	 * form (language => text), and will be used as the source of translations.
	 *
	 * This function can also do replacements into the translated tag. It will search the
	 * translated tag for the keys provided in $replacements, and replace any found occurances
	 * with the value of the key.
	 *
	 * @param string|array $tag  A tag name for the translation which should be looked up, or an
	 *                           array with (language => text) mappings.
	 * @param array $replacements  An associative array of keys that should be replaced with
	 *                             values in the translated string.
	 * @return string  The translated tag, or a placeholder value if the tag wasn't found.
	 */
	public function t($tag, $replacements = array(), $fallbackdefault = true, $oldreplacements = array(), $striptags = FALSE) {
		if(!is_array($replacements)) {

			/* Old style call to t(...). Print warning to log. */
			$backtrace = debug_backtrace();
			$where = $backtrace[0]['file'] . ':' . $backtrace[0]['line'];
			SimpleSAML_Logger::warning('Deprecated use of SimpleSAML_Template::t(...) at ' . $where .
				'. Please update the code to use the new style of parameters.');

			/* For backwards compatibility. */
			if(!$replacements && $this->getTag($tag) === NULL) {
				SimpleSAML_Logger::warning('Code which uses $fallbackdefault === FALSE shouls be' .
					' updated to use the getTag-method instead.');
				return NULL;
			}

			$replacements = $oldreplacements;
		}

		if(is_array($tag)) {
			$tagData = $tag;
		} else {
			$tagData = $this->getTag($tag);
			if($tagData === NULL) {
				/* Tag not found. */
				SimpleSAML_Logger::info('Template: Looking up [' . $tag . ']: not translated at all.');
				return $this->t_not_translated($tag, $fallbackdefault);
			}
		}

		$translated = $this->getTranslation($tagData);

#		if (!empty($replacements)){		echo('<pre> [' . $tag . ']'); print_r($replacements); exit; }
		foreach ($replacements as $k => $v) {
			/* try to translate if no replacement is given */
			if ($v == NULL) $v = $this->t($k);
			$translated = str_replace($k, $v, $translated);
		}
		return $translated;
	}
	
	/**
	 * Return the string that should be used when no translation was found.
	 *
	 * @param $tag				A name tag of the string that should be returned.
	 * @param $fallbacktag		If set to TRUE and string was not found in any languages, return 
	 * 					the tag it self. If FALSE return NULL.
	 */
	private function t_not_translated($tag, $fallbacktag) {
		if ($fallbacktag) {
			return 'not translated (' . $tag . ')';
		} else {
			return $tag;
		}
	}
	
	
	/**
	 * You can include translation inline instead of putting translation
	 * in dictionaries. This function is reccomended to only be used from dynamic
	 * data, or when the translation is already provided from an external source, as
	 * a database or in metadata.
	 *
	 * @param $tag         The tag that has a translation
	 * @param $translation The translation array
	 */
	public function includeInlineTranslation($tag, $translation) {
		
		if (is_string($translation)) {
			$translation = array($this->getBaseLanguage() => $translation);
		} elseif (!is_array($translation)) {
			throw new Exception("Inline translation should be string or array. Is " . gettype($translation) . " now!");
		}
		
		SimpleSAML_Logger::debug('Template: Adding inline language translation for tag [' . $tag . ']');
		$this->langtext[$tag] = $translation;
	}
	
	/**
	 * Include language file from the dictionaries directory.
	 *
	 * @param $file         File name of dictionary to include
	 * @param $otherConfig  Optionally provide a different configuration object than
	 *  the one provided in the constructor to be used to find the dictionary directory.
	 *  This enables the possiblity of combining dictionaries inside simpleSAMLphp 
	 *  distribution with external dictionaries.
	 */
	public function includeLanguageFile($file, $otherConfig = null) {
		
		$filebase = null;
		if (!empty($otherConfig)) {
			$filebase = $otherConfig->getPathValue('dictionarydir', 'dictionaries/');
		} else {
			$filebase = $this->configuration->getPathValue('dictionarydir', 'dictionaries/');
		}
		

		$lang = $this->readDictionaryFile($filebase . $file);
		SimpleSAML_Logger::debug('Template: Merging language array. Loading [' . $file . ']');
		$this->langtext = array_merge($this->langtext, $lang);
	}


	/**
	 * Read a dictionary file.
	 *
	 * @param $filename  The absolute path to the dictionary file.
	 * @return The translation array which was found in the dictionary file.
	 */
	private function readDictionaryFile($filename) {
		assert('is_string($filename)');

		SimpleSAML_Logger::debug('Template: Reading [' . $filename . ']');

		if (!file_exists($filename)) {
			SimpleSAML_Logger::error($_SERVER['PHP_SELF'].' - Template: Could not find template file [' . $this->template . '] at [' . $filename . ']');
			return array();
		}

		$lang = NULL;
		include($filename);
		if (isset($lang)) {
			return $lang;
		}

		return array();
	}


	/**
	 * Show the template to the user.
	 */
	public function show() {

		$filename = $this->findTemplatePath($this->template);
		require_once($filename);
	}


	/**
	 * Find template path.
	 *
	 * This function locates the given template based on the template name.
	 * It will first search for the template in the current theme directory, and
	 * then the default theme.
	 *
	 * The template name may be on the form <module name>:<template path>, in which case
	 * it will search for the template file in the given module.
	 *
	 * An error will be thrown if the template file couldn't be found.
	 *
	 * @param string $template  The relative path from the theme directory to the template file.
	 * @return string  The absolute path to the template file.
	 */
	private function findTemplatePath($template) {
		assert('is_string($template)');

		$tmp = explode(':', $template, 2);
		if (count($tmp) === 2) {
			$templateModule = $tmp[0];
			$templateName = $tmp[1];
		} else {
			$templateModule = 'default';
			$templateName = $tmp[0];
		}

		$tmp = explode(':', $this->configuration->getString('theme.use', 'default'), 2);
		if (count($tmp) === 2) {
			$themeModule = $tmp[0];
			$themeName = $tmp[1];
		} else {
			$themeModule = NULL;
			$themeName = $tmp[0];
		}


		/* First check the current theme. */
		if ($themeModule !== NULL) {
			/* .../module/<themeModule>/themes/<themeName>/<templateModule>/<templateName> */

			$filename = SimpleSAML_Module::getModuleDir($themeModule) . '/themes/' . $themeName . '/' . $templateModule . '/' . $templateName;
			
		} elseif ($templateModule !== 'default') {
			/* .../module/<templateModule>/templates/<themeName>/<templateName> */
			$filename = SimpleSAML_Module::getModuleDir($templateModule) . '/templates/' . $templateName;
			
		} else {
			/* .../templates/<theme>/<templateName> */
			$filename = $this->configuration->getPathValue('templatedir', 'templates/') . $templateName;
		}

		if (file_exists($filename)) {
			return $filename;
		}


		/* Not found in current theme. */
		SimpleSAML_Logger::debug($_SERVER['PHP_SELF'].' - Template: Could not find template file [' .
			$template . '] at [' . $filename . '] - now trying the base template');


		/* Try default theme. */
		if ($templateModule !== 'default') {
			/* .../module/<templateModule>/templates/<templateName> */
			$filename = SimpleSAML_Module::getModuleDir($templateModule) . '/templates/' . $templateName;
			
		} else {
			/* .../templates/<templateName> */
			$filename = $this->configuration->getPathValue('templatedir', 'templates/') . '/' . $templateName;
		}

		if (file_exists($filename)) {
			return $filename;
		}


		/* Not found in default template - log error and throw exception. */
		$error = 'Template: Could not find template file [' . $template . '] at [' . $filename . ']';
		SimpleSAML_Logger::critical($_SERVER['PHP_SELF'] . ' - ' . $error);

		throw new Exception($error);
	}

}

?>
