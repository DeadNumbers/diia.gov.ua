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

/* /var/www/sitefiles/themes/diia/pages/services.htm */
class __TwigTemplate_13962253895a5728f666ad5db47f175a6b82f7201b11e91ae40fca77d924bde8 extends \Twig\Template
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
        $context['__cms_partial_params'] = [];
        echo $this->env->getExtension('Cms\Twig\Extension')->partialFunction("site/breadcrumbs"        , $context['__cms_partial_params']        , true        );
        unset($context['__cms_partial_params']);
        // line 2
        echo "
<section class=\"services-byletter_section\">
\t<div class=\"container\">
\t\t<div class=\"row\">
\t\t\t<div class=\"col-12\">
\t\t\t\t";
        // line 7
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["servicesByLetter"] ?? null), "letters", [], "any", false, false, false, 7));
        foreach ($context['_seq'] as $context["letter"] => $context["services"]) {
            // line 8
            echo "\t\t\t\t\t<div class=\"services-byletter_item\">
\t\t\t\t\t\t<div class=\"services-byletter_letter\">";
            // line 9
            echo twig_escape_filter($this->env, $context["letter"], "html", null, true);
            echo "</div>
\t\t\t\t\t\t";
            // line 10
            if (twig_length_filter($this->env, $context["services"])) {
                // line 11
                echo "\t\t\t\t\t\t\t";
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable($context["services"]);
                foreach ($context['_seq'] as $context["_key"] => $context["service"]) {
                    // line 12
                    echo "\t\t\t\t\t\t\t\t<div class=\"services-byletter_title\">
\t\t\t\t\t\t\t\t\t<a href=\"";
                    // line 13
                    echo KitSoft\Core\Twig\UrlFilter::url(twig_get_attribute($this->env, $this->source, $context["service"], "url", [], "any", false, false, false, 13));
                    echo "\">";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["service"], "title", [], "any", false, false, false, 13), "html", null, true);
                    echo "</a>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['service'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 16
                echo "\t\t\t\t\t\t";
            }
            // line 17
            echo "\t\t\t\t\t</div>
\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['letter'], $context['services'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 19
        echo "\t\t\t</div>
\t\t</div>
\t</div>
</section>

";
        // line 24
        echo $this->env->getExtension('Cms\Twig\Extension')->startBlock('scripts'        );
        // line 25
        echo "\t<script type=\"text/javascript\" src=\"";
        echo $this->extensions['Cms\Twig\Extension']->themeFilter([0 => "assets/javascript/build/static.bundle.js"]);
        echo "\"></script>
";
        // line 24
        echo $this->env->getExtension('Cms\Twig\Extension')->endBlock(true        );
    }

    public function getTemplateName()
    {
        return "/var/www/sitefiles/themes/diia/pages/services.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  104 => 24,  99 => 25,  97 => 24,  90 => 19,  83 => 17,  80 => 16,  69 => 13,  66 => 12,  61 => 11,  59 => 10,  55 => 9,  52 => 8,  48 => 7,  41 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "/var/www/sitefiles/themes/diia/pages/services.htm", "");
    }
}
