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

/* /var/www/sitefiles/themes/diia/layouts/404.htm */
class __TwigTemplate_eca9ff2d9ce0405267e5d412d40149ed935bf7625972d970c1d6d0bb70efd720 extends \Twig\Template
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
        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0\" />

        <title>";
        // line 7
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Дія"]);
        echo " - ";
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["this"] ?? null), "page", [], "any", false, false, false, 7), "title", [], "any", false, false, false, 7), "html", null, true);
        echo "</title>

        <meta name=\"description\" content=\"";
        // line 9
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["this"] ?? null), "page", [], "any", false, false, false, 9), "meta_description", [], "any", false, false, false, 9), "html", null, true);
        echo "\">
        <meta name=\"title\" content=\"";
        // line 10
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["this"] ?? null), "page", [], "any", false, false, false, 10), "meta_title", [], "any", false, false, false, 10), "html", null, true);
        echo "\">
        <meta name=\"author\" content=\"\">
        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1, shrink-to-fit=no\">
        <meta name=\"generator\" content=\"\">

        ";
        // line 15
        $context['__cms_partial_params'] = [];
        echo $this->env->getExtension('Cms\Twig\Extension')->partialFunction("site/favicon"        , $context['__cms_partial_params']        , true        );
        unset($context['__cms_partial_params']);
        // line 16
        echo "
        <link rel=\"stylesheet\" type=\"text/css\" href=\"";
        // line 17
        echo $this->extensions['Cms\Twig\Extension']->themeFilter([0 => "assets/javascript/build/style.css"]);
        echo "\" />
    </head>
    
    ";
        // line 20
        echo $this->env->getExtension('Cms\Twig\Extension')->pageFunction();
        // line 21
        echo "    
    <script type=\"text/javascript\" src=\"";
        // line 22
        echo $this->extensions['Cms\Twig\Extension']->themeFilter([0 => "assets/vendor/jquery-3.4.0/jquery-3.4.0.min.js", 1 => "assets/vendor/bootstrap-4.3.1/bootstrap.bundle.min.js", 2 => "assets/javascript/build/static.bundle.js", 3 => "@framework", 4 => "@framework.extras"]);
        // line 28
        echo "\">
    </script>
        
</html>";
    }

    public function getTemplateName()
    {
        return "/var/www/sitefiles/themes/diia/layouts/404.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  87 => 28,  85 => 22,  82 => 21,  80 => 20,  74 => 17,  71 => 16,  67 => 15,  59 => 10,  55 => 9,  48 => 7,  40 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "/var/www/sitefiles/themes/diia/layouts/404.htm", "");
    }
}
