<?php
	//for refer
	defined('BASEPATH') OR exit('No direct script access allowed');

	use Illuminate\Database\Capsule\Manager as DB;
	use Gettext\Translations;
	use Gettext\GettextTranslator;
	use Gettext\Translator;

	class Bk_translation extends CI_Controller
	{

		public function __construct()
		{
			parent::__construct();

		}

		public function po2array()
		{
			//var_dump(APPPATH.'locale/en_US2zh_TW.po');
			//import from a .po file:
			$translations = Translations::fromPoFile(APPPATH . 'locale/zh_TW/en_US2zh_TW.po');

			//var_dump($translations);
			//edit some translations:
			/*$translation = $translations->find(null, 'apple');
			if ($translation) {
				$translation->setTranslation('Mazá');
			}*/

			//export to a php array:
			$translations->toPhpArrayFile(APPPATH . 'locale/zh_TW/en_US2zh_TW.php');

			//and to a .mo file
			//$translations->toMoFile(APPPATH . 'locale/zh_TW/en_US2zh_TW.mo');
		}

		public function test()
		{
			//Create the translator instance
			$t = new Translator();

			//Load your translations (exported as PhpArray):
			$t->loadTranslations(APPPATH . 'locale/zh_TW/en_US2zh_TW.php');

			//Use it:
			//echo $t->gettext('Title'); // "Mazá"

			//If you want use global functions:
			$t->register();

			echo __('Title'); // "Mazá"
		}

	}