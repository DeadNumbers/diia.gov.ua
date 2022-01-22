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

/* /var/www/sitefiles/themes/diia/partials/site/sections/serviceInfo.htm */
class __TwigTemplate_b22661e558d6a0eaedb7ad4ade04ad0ec1a7765774c684bea292232db96152ef extends \Twig\Template
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
        echo "<section class=\"service-info_section\">
\t<div class=\"container\">
\t\t<div class=\"row\">
\t\t\t<div class=\"col-12\">
\t\t\t\t<div class=\"service-info\">
\t\t\t\t\t<div class=\"service-info_first\">
\t\t\t\t\t\t<div class=\"service-info_content\">
\t\t\t\t\t\t\t";
        // line 8
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["data"] ?? null), "primary", [], "any", false, false, false, 8));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 9
            echo "\t\t\t\t\t\t        <div class=\"service-info_first-item\">
\t\t\t\t\t\t        \t";
            // line 10
            if (twig_get_attribute($this->env, $this->source, $context["item"], "label", [], "any", false, false, false, 10)) {
                // line 11
                echo "\t\t\t\t\t\t\t\t\t\t<div class=\"service-info_first-label\">";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "label", [], "any", false, false, false, 11), "html", null, true);
                echo "</div>
\t\t\t\t\t\t\t\t\t";
            }
            // line 13
            echo "\t\t\t\t\t\t\t\t\t";
            if (twig_get_attribute($this->env, $this->source, $context["item"], "text", [], "any", false, false, false, 13)) {
                // line 14
                echo "\t\t\t\t\t\t\t\t\t<div class=\"service-info_first-text\">";
                echo twig_get_attribute($this->env, $this->source, $context["item"], "text", [], "any", false, false, false, 14);
                echo "</div>
\t\t\t\t\t\t\t\t\t";
            }
            // line 16
            echo "\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 18
        echo "\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t\t<div class=\"service-info_second\">
\t\t\t\t\t\t<div class=\"service-info_content\">
\t\t\t\t\t\t\t";
        // line 22
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["data"] ?? null), "secondary", [], "any", false, false, false, 22));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 23
            echo "\t\t\t\t\t\t        <div class=\"service-info_second-item\">
\t\t\t\t\t\t        \t";
            // line 24
            if (twig_get_attribute($this->env, $this->source, $context["item"], "label", [], "any", false, false, false, 24)) {
                // line 25
                echo "\t\t\t\t\t\t\t\t\t\t<div class=\"service-info_second-label\">";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "label", [], "any", false, false, false, 25), "html", null, true);
                echo "</div>
\t\t\t\t\t\t\t\t\t";
            }
            // line 27
            echo "\t\t\t\t\t\t\t\t\t";
            if (twig_get_attribute($this->env, $this->source, $context["item"], "text", [], "any", false, false, false, 27)) {
                // line 28
                echo "\t\t\t\t\t\t\t\t\t<div class=\"service-info_second-text\">";
                echo twig_get_attribute($this->env, $this->source, $context["item"], "text", [], "any", false, false, false, 28);
                echo "</div>
\t\t\t\t\t\t\t\t\t";
            }
            // line 30
            echo "\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 32
        echo "\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</div>
\t\t</div>
\t</div>
</section>";
    }

    public function getTemplateName()
    {
        return "/var/www/sitefiles/themes/diia/partials/site/sections/serviceInfo.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  114 => 32,  107 => 30,  101 => 28,  98 => 27,  92 => 25,  90 => 24,  87 => 23,  83 => 22,  77 => 18,  70 => 16,  64 => 14,  61 => 13,  55 => 11,  53 => 10,  50 => 9,  46 => 8,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "/var/www/sitefiles/themes/diia/partials/site/sections/serviceInfo.htm", "");
    }
}
