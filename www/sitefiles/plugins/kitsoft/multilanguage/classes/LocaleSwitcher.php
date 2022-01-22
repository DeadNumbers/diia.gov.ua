<?php namespace KitSoft\MultiLanguage\Classes;

use Illuminate\Database\Eloquent\Collection;
use KitSoft\MultiLanguage\Classes\Interfaces\LocaleSwitcherInterface;
use KitSoft\MultiLanguage\Classes\UrlGenerator;
use KitSoft\MultiLanguage\Models\Locale;
use KitSoft\Pages\Classes\PagesHelper;
use Model;

/**
 * LocaleSwitcher, generate links for page langs
 */
class LocaleSwitcher implements LocaleSwitcherInterface
{
	const DEFAULT_URL = '/';

	protected $object;
	protected $objectLangs;
	protected $locales;

	/**
	 * __construct
	 */
	public function __construct(Model $object)
	{
		$this->object = $object;
		$this->setLocales();
		$this->setObjectLangs();
	}

	/**
	 * setLocales
	 */
	protected function setLocales(): void
	{
		$this->locales = Locale::isEnabled()
			->lists('code');
	}

	/**
	 * setObjectLangs
	 */
	protected function setObjectLangs(): void
	{
		$this->objectLangs = $this->object->langs();
	}

	/**
	 * getLinks
	 */
	public function getLinks(): array
	{
		$result = [];

        foreach ($this->locales as $locale) {
        	$result[$locale] = $this->getLinkByLocale($locale);
        }

        return $result;
	}

	/**
	 * getLinkByLocale
	 */
	public function getLinkByLocale(string $locale)
	{
		if (!isset($this->objectLangs[$locale])) {
			return self::DEFAULT_URL;
		}

		if (!$object = $this->objectLangs[$locale]->object()) {
			return self::DEFAULT_URL;
		}

		if (!$object->isClassExtendedWith('KitSoft.Pages.Behaviors.RelationFinderModel')) {
			return self::DEFAULT_URL;
		}

		if (!$object->url) {
			return self::DEFAULT_URL;
		}

		return UrlGenerator::getUnlocalizedUrl($object->url);
	}
}