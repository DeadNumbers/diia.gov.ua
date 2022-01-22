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

/* /var/www/sitefiles/themes/diia/partials/lifeSituation/child.htm */
class __TwigTemplate_3f116b99b52c68a43bfe50416fa7b084a1d68be187ef7fe0c1caaea81ef2213b extends \Twig\Template
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
\t<div class=\"row\">
\t\t<div class=\"col-lg-10 col-xl-9\">
\t\t\t";
        // line 4
        if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["lifeSituation"] ?? null), "item", [], "any", false, false, false, 4), "title", [], "any", false, false, false, 4)) {
            // line 5
            echo "\t\t\t\t<h1 class=\"article-level-1\">
\t\t\t\t\t";
            // line 6
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["lifeSituation"] ?? null), "item", [], "any", false, false, false, 6), "title", [], "any", false, false, false, 6), "html", null, true);
            echo "
\t\t\t\t</h1>
\t\t\t";
        }
        // line 9
        echo "\t\t</div>
\t</div>
\t<div class=\"row justify-content-xl-between\">
\t\t<div class=\"col-lg-9 col-xl-8\">
\t\t\t";
        // line 13
        if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["lifeSituation"] ?? null), "item", [], "any", false, false, false, 13), "content", [], "any", false, false, false, 13)) {
            // line 14
            echo "\t\t\t\t<div class=\"editor-content editor-content_life-sit\">";
            echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["lifeSituation"] ?? null), "item", [], "any", false, false, false, 14), "content", [], "any", false, false, false, 14);
            echo "</div>
\t\t\t";
        }
        // line 16
        echo "
\t\t\t";
        // line 17
        if (twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["lifeSituation"] ?? null), "item", [], "any", false, false, false, 17), "raw_sections", [], "any", false, false, false, 17))) {
            // line 18
            echo "\t\t\t\t";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["lifeSituation"] ?? null), "item", [], "any", false, false, false, 18), "raw_sections", [], "any", false, false, false, 18));
            foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                // line 19
                echo "                    <section id=\"section-";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "id", [], "any", false, false, false, 19), "html", null, true);
                echo "\" class=\"life-sit-acc_section\">
\t\t\t\t\t    ";
                // line 20
                $context['__cms_partial_params'] = [];
                $context['__cms_partial_params']['data'] = twig_get_attribute($this->env, $this->source, $context["item"], "fields", [], "any", false, false, false, 20)                ;
                $context['__cms_partial_params']['title'] = twig_get_attribute($this->env, $this->source, $context["item"], "title", [], "any", false, false, false, 20)                ;
                echo $this->env->getExtension('Cms\Twig\Extension')->partialFunction(("site/sections/" . twig_get_attribute($this->env, $this->source, $context["item"], "name", [], "any", false, false, false, 20))                , $context['__cms_partial_params']                , true                );
                unset($context['__cms_partial_params']);
                // line 21
                echo "                    </section>
\t\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 23
            echo "\t\t\t";
        }
        // line 24
        echo "\t\t</div>
\t\t<div class=\"d-none d-lg-block col-lg-3\">
        \t<div class=\"btn-action_wrap full-width\">
                <div class=\"btn-action_title\">Поділитись порадою</div>
                <div class=\"btn-action_box\">
                    <div class=\"btn btn-action btn-action_fb\" tabindex=\"0\" role=\"button\" aria-pressed=\"false\" data-type=\"facebook\"></div>
                    <div class=\"btn btn-action btn-action_tw\" tabindex=\"0\" role=\"button\" aria-pressed=\"false\" data-type=\"twitter\"></div>
                    <div class=\"btn btn-action btn-action-tel d-none\" tabindex=\"0\" role=\"button\" aria-pressed=\"false\" data-type=\"telegram\"></div>
                </div>
            </div>
\t\t\t<div class=\"sidebar\">
\t\t\t\t";
        // line 35
        if (twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["lifeSituation"] ?? null), "item", [], "any", false, false, false, 35), "raw_sections", [], "any", false, false, false, 35))) {
            // line 36
            echo "\t\t\t\t\t<div class=\"sidebar_title\">";
            echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Зміст сторінки"]);
            echo "</div>
\t\t\t\t\t<div class=\"sidebar-list\">
\t\t\t\t\t\t";
            // line 38
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["lifeSituation"] ?? null), "item", [], "any", false, false, false, 38), "raw_sections", [], "any", false, false, false, 38));
            foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                // line 39
                echo "\t\t\t\t\t\t\t<div class=\"sidebar-list_item\">
\t\t\t\t\t\t\t\t   <a href=\"#section-";
                // line 40
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "id", [], "any", false, false, false, 40), "html", null, true);
                echo "\" class=\"sidebar-list_item-title\">";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "title", [], "any", false, false, false, 40), "html", null, true);
                echo "</a>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 43
            echo "\t\t\t\t\t</div>
\t\t\t\t";
        }
        // line 45
        echo "\t\t\t\t";
        if (twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["lifeSituation"] ?? null), "item", [], "any", false, false, false, 45), "siblings", [], "any", false, false, false, 45))) {
            // line 46
            echo "\t\t\t\t\t<div class=\"sidebar_title\">";
            echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Дізнайтесь також"]);
            echo "</div>
\t\t\t\t\t<div class=\"sidebar-list\">
\t\t\t\t\t\t";
            // line 48
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["lifeSituation"] ?? null), "item", [], "any", false, false, false, 48), "siblings", [], "any", false, false, false, 48));
            foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                // line 49
                echo "\t\t\t\t\t\t\t<div class=\"sidebar-list_item\">
\t\t\t\t\t\t\t\t   <a href=\"";
                // line 50
                echo KitSoft\Core\Twig\UrlFilter::url(twig_get_attribute($this->env, $this->source, $context["item"], "url", [], "any", false, false, false, 50));
                echo "\" class=\"sidebar-list_item-title\">";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "title", [], "any", false, false, false, 50), "html", null, true);
                echo "</a>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 53
            echo "\t\t\t\t\t</div>
\t\t\t\t";
        }
        // line 55
        echo "\t\t\t</div>
\t\t\t<!-- /sidebar -->
        </div>
\t</div>
</div>";
    }

    public function getTemplateName()
    {
        return "/var/www/sitefiles/themes/diia/partials/lifeSituation/child.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  172 => 55,  168 => 53,  157 => 50,  154 => 49,  150 => 48,  144 => 46,  141 => 45,  137 => 43,  126 => 40,  123 => 39,  119 => 38,  113 => 36,  111 => 35,  98 => 24,  95 => 23,  88 => 21,  82 => 20,  77 => 19,  72 => 18,  70 => 17,  67 => 16,  61 => 14,  59 => 13,  53 => 9,  47 => 6,  44 => 5,  42 => 4,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "/var/www/sitefiles/themes/diia/partials/lifeSituation/child.htm", "");
    }
}
