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

/* /var/www/sitefiles/themes/diia/partials/lifeSituation/parent.htm */
class __TwigTemplate_4261dffde54c419cfedd6510c2d5f940d0542e1e06fe83779744bd264c300460 extends \Twig\Template
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
        echo "<div class=\"container\">
\t<div class=\"row align-items-lg-center life-sit_type\">
\t\t<div class=\"col-lg-6\">
\t\t\t";
        // line 4
        if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["lifeSituation"] ?? null), "item", [], "any", false, false, false, 4), "title", [], "any", false, false, false, 4)) {
            // line 5
            echo "\t\t\t\t<div class=\"life-sit_type-title\">";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["lifeSituation"] ?? null), "item", [], "any", false, false, false, 5), "title", [], "any", false, false, false, 5), "html", null, true);
            echo "</div>
\t\t\t";
        }
        // line 7
        echo "\t\t\t";
        if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["lifeSituation"] ?? null), "item", [], "any", false, false, false, 7), "excerpt", [], "any", false, false, false, 7)) {
            // line 8
            echo "\t\t\t\t<div class=\"life-sit_type-excerpt\">";
            echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["lifeSituation"] ?? null), "item", [], "any", false, false, false, 8), "excerpt", [], "any", false, false, false, 8);
            echo "</div>
\t\t\t";
        }
        // line 10
        echo "\t\t</div>
\t\t<div class=\"col-lg-6\">
\t\t\t";
        // line 12
        if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["lifeSituation"] ?? null), "item", [], "any", false, false, false, 12), "image", [], "any", false, false, false, 12), "path", [], "any", false, false, false, 12)) {
            // line 13
            echo "\t\t\t\t<img src=\"";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["lifeSituation"] ?? null), "item", [], "any", false, false, false, 13), "image", [], "any", false, false, false, 13), "path", [], "any", false, false, false, 13), "html", null, true);
            echo "\" alt=\"";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["lifeSituation"] ?? null), "item", [], "any", false, false, false, 13), "title", [], "any", false, false, false, 13), "html", null, true);
            echo "\" class=\"img-fluid life-sit_type-img\">
\t\t\t";
        }
        // line 15
        echo "\t\t</div>
\t</div>
</div>

";
        // line 19
        if (twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["lifeSituation"] ?? null), "item", [], "any", false, false, false, 19), "childs", [], "any", false, false, false, 19))) {
            // line 20
            echo "<section class=\"service-acc_section\">
    <div class=\"container\">
        <div class=\"row\">
        \t<div class=\"col-12\">
                ";
            // line 24
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["lifeSituation"] ?? null), "item", [], "any", false, false, false, 24), "childs", [], "any", false, false, false, 24));
            foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                // line 25
                echo "                    <div class=\"service-acc_item\">
                        <a href=\"";
                // line 26
                echo KitSoft\Core\Twig\UrlFilter::url(twig_get_attribute($this->env, $this->source, $context["item"], "url", [], "any", false, false, false, 26));
                echo "\" class=\"service-acc_item-service\">";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "title", [], "any", false, false, false, 26), "html", null, true);
                echo "</a>
                    </div>
                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 29
            echo "            </div>
        </div>
    </div>
</section>
";
        }
    }

    public function getTemplateName()
    {
        return "/var/www/sitefiles/themes/diia/partials/lifeSituation/parent.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  105 => 29,  94 => 26,  91 => 25,  87 => 24,  81 => 20,  79 => 19,  73 => 15,  65 => 13,  63 => 12,  59 => 10,  53 => 8,  50 => 7,  44 => 5,  42 => 4,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "/var/www/sitefiles/themes/diia/partials/lifeSituation/parent.htm", "");
    }
}
