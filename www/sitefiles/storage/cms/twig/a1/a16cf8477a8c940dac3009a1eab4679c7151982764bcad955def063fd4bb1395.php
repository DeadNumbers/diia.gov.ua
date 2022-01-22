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

/* /var/www/sitefiles/themes/diia/pages/500.htm */
class __TwigTemplate_fa548f1d3d232dfad2deb176e6f876c1301f238baddd8033acd4f059fb64e4f0 extends \Twig\Template
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
        // line 1
        echo "<!DOCTYPE html>
<html lang=\"";
        // line 2
        echo KitSoft\MultiLanguage\Twig\Functions::getActiveLocale();
        echo "\">

<head>
    <meta charset=\"utf-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1, shrink-to-fit=no\">
    <title>";
        // line 7
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["this"] ?? null), "page", [], "any", false, false, false, 7), "title", [], "any", false, false, false, 7), "html", null, true);
        echo "</title>
    <link rel=\"icon\" type=\"image/png\" sizes=\"16x16\" href=\"";
        // line 8
        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/images/favicon/favicon.png");
        echo "\" />
    <link rel=\"stylesheet\" type=\"text/css\" href=\"";
        // line 9
        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/javascript/build/style.css");
        echo "\" />
</head>

<body>
    <div class=\"not-exist\">
        <div class=\"not-exist_inner\">
            <img src=\"";
        // line 15
        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/images/warning-500.svg");
        echo "\" alt=\"not-exist-page\" class=\"not-exist_icn\">
            <h2 class=\"not-exist_lead\">ПОМИЛКА НА СТОРІНЦІ</h2>
            <p class=\"not-exist_text\">На жаль, сторінка не може бути відображена через помилку.</p>
            <p class=\"not-exist_text\">Вибачте за тимчасові незручності</p>
        </div>
    </div>
</body>

</html>";
    }

    public function getTemplateName()
    {
        return "/var/www/sitefiles/themes/diia/pages/500.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  65 => 15,  56 => 9,  52 => 8,  48 => 7,  40 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "/var/www/sitefiles/themes/diia/pages/500.htm", "");
    }
}
