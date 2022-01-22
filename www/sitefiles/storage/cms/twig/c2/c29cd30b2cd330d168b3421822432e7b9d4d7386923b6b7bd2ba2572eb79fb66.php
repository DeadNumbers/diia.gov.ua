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

/* /var/www/sitefiles/themes/diia/partials/site/sections/lifeSituations.htm */
class __TwigTemplate_3936b17243d9d5642815daddbe606cb3194942d21ed250c87ea49fb5d5c031ee extends \Twig\Template
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
        echo "<section class=\"situations_section\">
    <div class=\"container\">
        <div class=\"row\">
            <div class=\"col-lg-6\">
                <div class=\"situations_head-title\">";
        // line 5
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["data"] ?? null), "title", [], "any", false, false, false, 5), "html", null, true);
        echo "</div>
            </div>
            <div class=\"col-lg-6\">
                ";
        // line 8
        if (twig_get_attribute($this->env, $this->source, ($context["data"] ?? null), "description", [], "any", false, false, false, 8)) {
            echo "                
                    <div class=\"situations_head-text\">";
            // line 9
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["data"] ?? null), "description", [], "any", false, false, false, 9), "html", null, true);
            echo "</div>
                ";
        }
        // line 11
        echo "            </div>
        </div>
        <div class=\"row\">
            ";
        // line 14
        if (twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["subCategoriesLifeSituations"] ?? null), "subcategories", [], "any", false, false, false, 14))) {
            // line 15
            echo "            \t";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["subCategoriesLifeSituations"] ?? null), "subcategories", [], "any", false, false, false, 15));
            $context['loop'] = [
              'parent' => $context['_parent'],
              'index0' => 0,
              'index'  => 1,
              'first'  => true,
            ];
            if (is_array($context['_seq']) || (is_object($context['_seq']) && $context['_seq'] instanceof \Countable)) {
                $length = count($context['_seq']);
                $context['loop']['revindex0'] = $length - 1;
                $context['loop']['revindex'] = $length;
                $context['loop']['length'] = $length;
                $context['loop']['last'] = 1 === $length;
            }
            foreach ($context['_seq'] as $context["_key"] => $context["subcategory"]) {
                // line 16
                echo "    \t            <div class=\"col-lg-4\">
                        <div class=\"question_item ";
                // line 17
                if (twig_get_attribute($this->env, $this->source, $context["loop"], "first", [], "any", false, false, false, 17)) {
                    echo "first";
                }
                echo "\">
                            <div class=\"question_item-category js-question_item-category\">
                                <div class=\"question_item-category-text\">
                                    ";
                // line 20
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["subcategory"], "name", [], "any", false, false, false, 20), "html", null, true);
                echo "
                                </div>
                            </div>
                            ";
                // line 23
                if (twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, $context["subcategory"], "life_situations", [], "any", false, false, false, 23))) {
                    // line 24
                    echo "                            <div class=\"question_item-content\">
                                ";
                    // line 25
                    $context['_parent'] = $context;
                    $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["subcategory"], "life_situations", [], "any", false, false, false, 25));
                    foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                        // line 26
                        echo "                                    <a href=\"";
                        echo KitSoft\Core\Twig\UrlFilter::url(twig_get_attribute($this->env, $this->source, $context["item"], "url", [], "any", false, false, false, 26));
                        echo "\" class=\"question_item-text\">";
                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "title", [], "any", false, false, false, 26), "html", null, true);
                        echo "</a>
                                ";
                    }
                    $_parent = $context['_parent'];
                    unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
                    $context = array_intersect_key($context, $_parent) + $_parent;
                    // line 28
                    echo "                             </div>
                            ";
                }
                // line 30
                echo "                        </div>
    \t                ";
                // line 37
                echo "    \t            </div>
                ";
                ++$context['loop']['index0'];
                ++$context['loop']['index'];
                $context['loop']['first'] = false;
                if (isset($context['loop']['length'])) {
                    --$context['loop']['revindex0'];
                    --$context['loop']['revindex'];
                    $context['loop']['last'] = 0 === $context['loop']['revindex0'];
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['subcategory'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 39
            echo "            ";
        }
        // line 40
        echo "        </div>
    </div>
</section>";
    }

    public function getTemplateName()
    {
        return "/var/www/sitefiles/themes/diia/partials/site/sections/lifeSituations.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  145 => 40,  142 => 39,  127 => 37,  124 => 30,  120 => 28,  109 => 26,  105 => 25,  102 => 24,  100 => 23,  94 => 20,  86 => 17,  83 => 16,  65 => 15,  63 => 14,  58 => 11,  53 => 9,  49 => 8,  43 => 5,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "/var/www/sitefiles/themes/diia/partials/site/sections/lifeSituations.htm", "");
    }
}
