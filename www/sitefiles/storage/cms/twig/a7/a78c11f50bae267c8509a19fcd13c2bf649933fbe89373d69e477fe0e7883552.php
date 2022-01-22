<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* /var/www/sitefiles/themes/diia/partials/site/favicon.htm */
class __TwigTemplate_d91d4d48f510f6f0f2a9a9b54a70ab2f085f240b37c2968ec0ec7009018ee16c extends \Twig\Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 18
        echo "<link rel=\"icon\" type=\"image/png\" sizes=\"96x96\" href=\"";
        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/images/favicon/favicon-96x96.png");
        echo "\"/>
<link rel=\"icon\" type=\"image/png\" sizes=\"72x72\" href=\"";
        // line 19
        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/images/favicon/android-icon-72x72.png");
        echo "\"/>
<link rel=\"apple-touch-icon\" sizes=\"72x72\" href=\"";
        // line 20
        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/images/favicon/apple-icon-72x72.png");
        echo "\"/>
<link rel=\"icon\" type=\"image/png\" sizes=\"48x48\" href=\"";
        // line 21
        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/images/favicon/android-icon-48x48.png");
        echo "\"/>
<link rel=\"icon\" type=\"image/png\" sizes=\"36x36\" href=\"";
        // line 22
        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/images/favicon/android-icon-36x36.png");
        echo "\"/>
<link rel='shortcut icon' type='image/png' href=\"";
        // line 23
        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/images/favicon/favicon.png");
        echo "\" />";
    }

    public function getTemplateName()
    {
        return "/var/www/sitefiles/themes/diia/partials/site/favicon.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  58 => 23,  54 => 22,  50 => 21,  46 => 20,  42 => 19,  37 => 18,);
    }

    public function getSourceContext()
    {
        return new Source("", "/var/www/sitefiles/themes/diia/partials/site/favicon.htm", "");
    }
}
