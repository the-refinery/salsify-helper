<?php
/**
 * salsifyhelper plugin for Craft CMS 3.x
 *
 * Helper function for Feed Me Salsify
 *
 * @link      https://the-refinery.io
 * @copyright Copyright (c) 2020 The Refinery
 */

namespace therefinery\salsifyhelper\twigextensions;

use therefinery\salsifyhelper\Salsifyhelper;

use Craft;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

/**
 * Twig can be extended in many ways; you can add extra tags, filters, tests, operators,
 * global variables, and functions. You can even extend the parser itself with
 * node visitors.
 *
 * http://twig.sensiolabs.org/doc/advanced.html
 *
 * @author    The Refinery
 * @package   Salsifyhelper
 * @since     3.0.0
 */
class SalsifyhelperTwigExtension extends AbstractExtension
{

    public function getName()
    {
        return 'Salsifyhelper';
    }

    public function getFilters()
    {
        return [
            new TwigFilter('checkForInheritedValue', [$this, 'checkForInheritedValue']),
            new TwigFilter('productionUrl', [$this, 'productionUrl']),
        ];
    }

    public function checkForInheritedValue($fieldName, $entry, $parent)
    {
        if (isset($entry->$fieldName) && !empty($entry->$fieldName)){
            return $entry->$fieldName;
        } else {
             return $parent->$fieldName;
        }
    }

     public function productionUrl($envUrl){
        $localBase = Craft::$app->config->general->siteUrl;
        $productionUrl = getenv('PRODUCTION_URL');
        return $productionUrl ? str_replace($localBase, $productionUrl, $envUrl) : $envUrl;
    }
}
