<?php
namespace AppBundle\Twig;

use Symfony\Component\Intl\Intl;

class LocaleExtension extends \Twig_Extension {

    public function getFilters() {
        return array(
            new \Twig_SimpleFilter('locale', array($this, 'localeFilter')),
            new \Twig_SimpleFilter('locales', array($this, 'localesFilter'))
        );
    }

    public function localeFilter($localeCode, $locale = null){
        return Intl::getLocaleBundle()->getLocaleName($localeCode, $locale);
    }

    public function localesFilter($localeCodes, $locale = null){
        $hostLanguages = array();
        foreach ($localeCodes as $code) {
            $hostLanguages[] = ucfirst(Intl::getLanguageBundle()->getLanguageName($code, $locale));
        }
        return $hostLanguages;
    }

    public function getName()
    {
        return 'locale_extension';
    }

}