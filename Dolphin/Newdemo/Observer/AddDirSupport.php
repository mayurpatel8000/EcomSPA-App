<?php

declare(strict_types=1);

namespace Dolphin\Newdemo\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Locale\ResolverInterface;
use Magento\Framework\View\Page\Config as PageConfig;

class AddDirSupport implements ObserverInterface
{
    private $localeResolver;
    private $pageConfig;

    public function __construct(
        ResolverInterface $localeResolver,
        PageConfig $pageConfig
    ) {
        $this->localeResolver = $localeResolver;
        $this->pageConfig = $pageConfig;
    }

    /**
     * @inheritDoc
     */
    public function execute(Observer $observer)
    {
        $currentLang = strtolower(substr($this->localeResolver->getLocale(), 0, 2));
        $rtlLanguages = array('ar', 'arc', 'dv', 'fa', 'ha', 'he', 'khw', 'ks', 'ku', 'ps', 'ur', 'yi');
        $isRtl = in_array($currentLang, $rtlLanguages);
        $this->pageConfig->setElementAttribute(
            PageConfig::ELEMENT_TYPE_HTML,
            'dir',
            $isRtl ? 'rtl' : 'ltr'
        );
    }
}

?>