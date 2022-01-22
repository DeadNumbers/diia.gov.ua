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

/* /var/www/sitefiles/themes/diia/partials/site/sections/faq.htm */
class __TwigTemplate_eed046365a326b2d9d643ba2f10e39b24f8fa48ad07549e1e7d1b19529e93f7d extends \Twig\Template
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
        echo "<section class=\"question_section\">
    <div class=\"container\">
        <div class=\"row align-items-center align-items-lg-end justify-content-lg-between\">
            <div class=\"col-8 col-lg-6\">
                <h1 class=\"article-level-1\">Питання <br>та відповіді</h1>
            </div>
            <div class=\"col-4\">
            \t<div class=\"question_section-all\">
            \t\t<div class=\"wrap-all-link\">
\t                    <a href=\"";
        // line 10
        echo KitSoft\Core\Twig\UrlFilter::url(twig_get_attribute($this->env, $this->source, KitSoft\Core\Twig\Functions::getPageByTemplate("questions"), "url", [], "any", false, false, false, 10));
        echo "\" class=\"wrap-all-link_link\">
\t                        <span>Всі питання та відповіді</span>
\t                    </a>
\t                </div>
            \t</div>
            </div>
        </div>
        <div class=\"row\">
        \t";
        // line 18
        if (twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["faqCategories"] ?? null), "categories", [], "any", false, false, false, 18))) {
            // line 19
            echo "\t\t\t\t";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["faqCategories"] ?? null), "categories", [], "any", false, false, false, 19));
            $context['loop'] = [
              'parent' => $context['_parent'],
              'index0' => 0,
              'index'  => 1,
              'first'  => true,
            ];
            foreach ($context['_seq'] as $context["_key"] => $context["category"]) {
                if (twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, $context["category"], "questions", [], "any", false, false, false, 19))) {
                    // line 20
                    echo "\t\t\t\t\t<div class=\"col-lg-4\">
\t\t\t\t\t\t<div class=\"question_item ";
                    // line 21
                    if (twig_get_attribute($this->env, $this->source, $context["loop"], "first", [], "any", false, false, false, 21)) {
                        echo "first";
                    }
                    echo "\">
\t\t\t\t\t\t\t<div class=\"question_item-category js-question_item-category\">
\t\t\t\t\t\t\t \t<div class=\"question_item-category-text\">
\t\t\t\t\t\t\t \t\t";
                    // line 24
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["category"], "name", [], "any", false, false, false, 24), "html", null, true);
                    echo "
\t\t\t\t\t\t\t \t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t";
                    // line 27
                    if (twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, $context["category"], "questions", [], "any", false, false, false, 27))) {
                        // line 28
                        echo "\t\t\t\t\t\t\t<div class=\"question_item-content\">
\t\t\t\t\t\t\t \t";
                        // line 29
                        $context['_parent'] = $context;
                        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["category"], "questions", [], "any", false, false, false, 29));
                        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                            // line 30
                            echo "\t\t\t\t\t\t\t\t\t<a href=\"";
                            echo KitSoft\Core\Twig\UrlFilter::url(twig_get_attribute($this->env, $this->source, $context["item"], "url", [], "any", false, false, false, 30));
                            echo "\" class=\"question_item-text\">";
                            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "question", [], "any", false, false, false, 30), "html", null, true);
                            echo "</a>
\t\t\t\t\t\t\t\t";
                        }
                        $_parent = $context['_parent'];
                        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
                        $context = array_intersect_key($context, $_parent) + $_parent;
                        // line 32
                        echo "\t\t\t\t\t\t\t </div>
\t\t\t\t\t\t\t";
                    }
                    // line 34
                    echo "\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t";
                    ++$context['loop']['index0'];
                    ++$context['loop']['index'];
                    $context['loop']['first'] = false;
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['category'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 37
            echo "\t\t\t";
        }
        // line 38
        echo "        </div>
    </div>
</section>";
    }

    public function getTemplateName()
    {
        return "/var/www/sitefiles/themes/diia/partials/site/sections/faq.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  129 => 38,  126 => 37,  114 => 34,  110 => 32,  99 => 30,  95 => 29,  92 => 28,  90 => 27,  84 => 24,  76 => 21,  73 => 20,  61 => 19,  59 => 18,  48 => 10,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "/var/www/sitefiles/themes/diia/partials/site/sections/faq.htm", "");
    }
}
