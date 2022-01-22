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

/* /var/www/sitefiles/themes/diia/pages/question.htm */
class __TwigTemplate_6573e5efdf7805841473c5a0733083db82200077533e3dbb15708a974d87e8a0 extends \Twig\Template
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
<section class=\"page-question\">
\t<div class=\"container\">
\t\t<div class=\"row\">
            <div class=\"col-12\">
                <div class=\"page_title page_title-faq\">
                    <h1 class=\"page_title-text\">";
        // line 8
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["faqQuestion"] ?? null), "question", [], "any", false, false, false, 8), "question", [], "any", false, false, false, 8), "html", null, true);
        echo "</h1>
                </div>
            </div>
        </div>
        <div class=\"row justify-content-xl-between\">
\t        <div class=\"col-md-8\">
\t            <div class=\"editor-content\">
\t                ";
        // line 15
        echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["faqQuestion"] ?? null), "question", [], "any", false, false, false, 15), "answer", [], "any", false, false, false, 15);
        echo "
\t            </div>
\t        </div>
\t        ";
        // line 18
        if (twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["faqQuestion"] ?? null), "question", [], "any", false, false, false, 18), "related_questions", [], "any", false, false, false, 18))) {
            // line 19
            echo "\t        \t<div class=\"col-md-4 col-xl-3\">
\t\t\t\t\t<div class=\"sidebar sidebar-question\">
\t\t\t\t\t\t<div class=\"sidebar_title\">";
            // line 21
            echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Пов'язані запитання"]);
            echo "</div>
                        ";
            // line 22
            if (twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["faqQuestion"] ?? null), "question", [], "any", false, false, false, 22), "related_questions", [], "any", false, false, false, 22))) {
                // line 23
                echo "                            <div class=\"sidebar-list\">
                                ";
                // line 24
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["faqQuestion"] ?? null), "question", [], "any", false, false, false, 24), "related_questions", [], "any", false, false, false, 24));
                foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                    // line 25
                    echo "                                    <div class=\"sidebar-list_item\">
                                        <a href=\"";
                    // line 26
                    echo KitSoft\Core\Twig\UrlFilter::url(twig_get_attribute($this->env, $this->source, $context["item"], "url", [], "any", false, false, false, 26));
                    echo "\" class=\"sidebar-list_item-title\" ";
                    if ((twig_get_attribute($this->env, $this->source, $context["item"], "answer_type", [], "any", false, false, false, 26) == "link")) {
                        echo "target=\"_blank\"";
                    }
                    echo ">";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "question", [], "any", false, false, false, 26), "html", null, true);
                    echo "</a>
                                    </div>
                                ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 29
                echo "                            </div>
                        ";
            }
            // line 31
            echo "\t\t\t\t\t</div>
\t        \t</div>
\t        ";
        }
        // line 34
        echo "\t    </div>
\t</div>
</section>

";
        // line 38
        echo $this->env->getExtension('Cms\Twig\Extension')->startBlock('scripts'        );
        // line 39
        echo "\t<script type=\"text/javascript\" src=\"";
        echo $this->extensions['Cms\Twig\Extension']->themeFilter([0 => "assets/javascript/build/static.bundle.js"]);
        echo "\"></script>
";
        // line 38
        echo $this->env->getExtension('Cms\Twig\Extension')->endBlock(true        );
    }

    public function getTemplateName()
    {
        return "/var/www/sitefiles/themes/diia/pages/question.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  124 => 38,  119 => 39,  117 => 38,  111 => 34,  106 => 31,  102 => 29,  87 => 26,  84 => 25,  80 => 24,  77 => 23,  75 => 22,  71 => 21,  67 => 19,  65 => 18,  59 => 15,  49 => 8,  41 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "/var/www/sitefiles/themes/diia/pages/question.htm", "");
    }
}
