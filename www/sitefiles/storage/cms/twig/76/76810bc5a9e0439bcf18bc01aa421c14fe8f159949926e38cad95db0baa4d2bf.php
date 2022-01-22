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

/* /var/www/sitefiles/themes/diia/layouts/default.htm */
class __TwigTemplate_fb455fc6f3eeb476c4d7606da88e8ec6eb3d1b0a83d87240bcdda26576b360a9 extends \Twig\Template
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
        // line 2
        echo "
<!DOCTYPE html>
<html lang=\"";
        // line 4
        echo KitSoft\MultiLanguage\Twig\Functions::getActiveLocale();
        echo "\">
    <head>
        <meta charset=\"utf-8\">
        <title>";
        // line 7
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["this"] ?? null), "page", [], "any", false, false, false, 7), "title", [], "any", false, false, false, 7), "html", null, true);
        echo " | ";
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Дія"]);
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
        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=0\">
        <meta name=\"generator\" content=\"\">

        ";
        // line 15
        $context['__cms_partial_params'] = [];
        echo $this->env->getExtension('Cms\Twig\Extension')->partialFunction("site/openGraph"        , $context['__cms_partial_params']        , true        );
        unset($context['__cms_partial_params']);
        // line 16
        echo "        ";
        $context['__cms_partial_params'] = [];
        echo $this->env->getExtension('Cms\Twig\Extension')->partialFunction("site/favicon"        , $context['__cms_partial_params']        , true        );
        unset($context['__cms_partial_params']);
        // line 17
        echo "
        ";
        // line 18
        echo $this->env->getExtension('Cms\Twig\Extension')->assetsFunction('css');
        echo $this->env->getExtension('Cms\Twig\Extension')->displayBlock('styles');
        // line 19
        echo "
        <link rel=\"stylesheet\" type=\"text/css\" href=\"";
        // line 20
        echo $this->extensions['Cms\Twig\Extension']->themeFilter([0 => "assets/vendor/swiper-5.3.0/css/swiper.min.css", 1 => "assets/javascript/build/style.css"]);
        // line 23
        echo "\"/>

        ";
        // line 25
        $context['__cms_component_params'] = [];
        echo $this->env->getExtension('Cms\Twig\Extension')->componentFunction("googleAnalytics"        , $context['__cms_component_params']        );
        unset($context['__cms_component_params']);
        // line 26
        echo "
        ";
        // line 27
        $context['__cms_component_params'] = [];
        echo $this->env->getExtension('Cms\Twig\Extension')->componentFunction("googleTracker"        , $context['__cms_component_params']        );
        unset($context['__cms_component_params']);
        // line 28
        echo "    </head>

    <body>
        <div class=\"wrapper";
        // line 31
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["this"] ?? null), "page", [], "any", false, false, false, 31), "bodyClass", [], "any", false, false, false, 31), "html", null, true);
        echo "\" id=\"layout-wrapper\">
            ";
        // line 32
        if ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "data", [], "any", false, false, false, 32), "slug", [], "any", false, false, false, 32) == "/")) {
            // line 33
            echo "                ";
            $context['__cms_partial_params'] = [];
            echo $this->env->getExtension('Cms\Twig\Extension')->partialFunction("site/header"            , $context['__cms_partial_params']            , true            );
            unset($context['__cms_partial_params']);
            // line 34
            echo "            ";
        } else {
            // line 35
            echo "                ";
            $context['__cms_partial_params'] = [];
            echo $this->env->getExtension('Cms\Twig\Extension')->partialFunction("site/thinHeader"            , $context['__cms_partial_params']            , true            );
            unset($context['__cms_partial_params']);
            // line 36
            echo "            ";
        }
        // line 37
        echo "
            <main id=\"layout-main\">
                ";
        // line 39
        echo $this->env->getExtension('Cms\Twig\Extension')->pageFunction();
        // line 40
        echo "            </main>
            ";
        // line 41
        $context['__cms_partial_params'] = [];
        echo $this->env->getExtension('Cms\Twig\Extension')->partialFunction("site/footer"        , $context['__cms_partial_params']        , true        );
        unset($context['__cms_partial_params']);
        // line 42
        echo "        </div>
        ";
        // line 43
        $context['__cms_partial_params'] = [];
        echo $this->env->getExtension('Cms\Twig\Extension')->partialFunction("site/cookie"        , $context['__cms_partial_params']        , true        );
        unset($context['__cms_partial_params']);
        // line 44
        echo "        ";
        $context['__cms_partial_params'] = [];
        echo $this->env->getExtension('Cms\Twig\Extension')->partialFunction("site/chatbot"        , $context['__cms_partial_params']        , true        );
        unset($context['__cms_partial_params']);
        // line 45
        echo "        <div class=\"d-none\" id=\"page-hash\" data-hash=\"";
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["this"] ?? null), "page", [], "any", false, false, false, 45), "hash", [], "any", false, false, false, 45), "html", null, true);
        echo "\"></div>
        <div class=\"overlay-full-screen\"></div>
        ";
        // line 47
        $context['__cms_partial_params'] = [];
        echo $this->env->getExtension('Cms\Twig\Extension')->partialFunction("site/ieBlock"        , $context['__cms_partial_params']        , true        );
        unset($context['__cms_partial_params']);
        // line 48
        echo "
        <script type=\"text/javascript\" src=\"";
        // line 49
        echo $this->extensions['Cms\Twig\Extension']->themeFilter([0 => "assets/vendor/jquery-3.4.0/jquery-3.4.0.min.js", 1 => "assets/vendor/bootstrap-4.3.1/bootstrap.bundle.min.js", 2 => "assets/vendor/moment-2.24.0/moment.min.js", 3 => "assets/vendor/moment-2.24.0/locale/uk.js", 4 => "@framework", 5 => "@framework.extras"]);
        // line 56
        echo "\">
        </script>

        ";
        // line 59
        echo $this->env->getExtension('Cms\Twig\Extension')->assetsFunction('js');
        echo $this->env->getExtension('Cms\Twig\Extension')->displayBlock('scripts');
        // line 60
        echo "    </body>
</html>";
    }

    public function getTemplateName()
    {
        return "/var/www/sitefiles/themes/diia/layouts/default.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  176 => 60,  173 => 59,  168 => 56,  166 => 49,  163 => 48,  159 => 47,  153 => 45,  148 => 44,  144 => 43,  141 => 42,  137 => 41,  134 => 40,  132 => 39,  128 => 37,  125 => 36,  120 => 35,  117 => 34,  112 => 33,  110 => 32,  106 => 31,  101 => 28,  97 => 27,  94 => 26,  90 => 25,  86 => 23,  84 => 20,  81 => 19,  78 => 18,  75 => 17,  70 => 16,  66 => 15,  58 => 10,  54 => 9,  47 => 7,  41 => 4,  37 => 2,);
    }

    public function getSourceContext()
    {
        return new Source("", "/var/www/sitefiles/themes/diia/layouts/default.htm", "");
    }
}
