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

/* /var/www/sitefiles/themes/diia/pages/questions.htm */
class __TwigTemplate_e808a322b94ce70546ec1f8ad1af45797c221908138ace93480f5141d5c2fdef extends \Twig\Template
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
<section>
    <div class=\"container\">
        <div class=\"row\">
            <div class=\"col-12\">
                <h1 class=\"article-level-1\">";
        // line 7
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "data", [], "any", false, false, false, 7), "title", [], "any", false, false, false, 7), "html", null, true);
        echo "</h1>
            </div>
        </div>
    </div>
    <div class=\"container faq_container\">
        ";
        // line 12
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["faqCategories"] ?? null), "categories", [], "any", false, false, false, 12));
        foreach ($context['_seq'] as $context["_key"] => $context["category"]) {
            // line 13
            echo "            <div class=\"faq_item\">
                <div class=\"col-md-4 col-xl-3 faq_item-title-box\">
                    <div class=\"faq_item-title js-faq_item-title\">";
            // line 15
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["category"], "name", [], "any", false, false, false, 15), "html", null, true);
            echo "</div>
                </div>
                <div class=\"faq_item-list\">
                    ";
            // line 18
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["category"], "questions", [], "any", false, false, false, 18));
            foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                // line 19
                echo "                    <div class=\"faq_item-answer\">
                        <a href=\"";
                // line 20
                echo KitSoft\Core\Twig\UrlFilter::url(twig_get_attribute($this->env, $this->source, $context["item"], "url", [], "any", false, false, false, 20));
                echo "\" class=\"faq_item-answer-link\" ";
                if ((twig_get_attribute($this->env, $this->source, $context["item"], "answer_type", [], "any", false, false, false, 20) == "link")) {
                    echo "target=\"_blank\" ";
                }
                echo ">
                            ";
                // line 21
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "question", [], "any", false, false, false, 21), "html", null, true);
                echo "
                        </a>
                    </div>
                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 25
            echo "                </div>
            </div>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['category'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 28
        echo "    </div>
    <div class=\"container\">
        <div class=\"hr-faq-container\"></div>
    </div>
</section>

";
        // line 34
        $context['__cms_component_params'] = [];
        echo $this->env->getExtension('Cms\Twig\Extension')->componentFunction("form::faqForm"        , $context['__cms_component_params']        );
        unset($context['__cms_component_params']);
        // line 35
        echo "
";
        // line 36
        echo $this->env->getExtension('Cms\Twig\Extension')->startBlock('scripts'        );
        // line 37
        echo "\t<script type=\"text/javascript\" src=\"";
        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/vendor/validate-1.19.1/jquery.validate.min.js");
        echo "\"></script>
\t<script type=\"text/javascript\" src=\"";
        // line 38
        echo $this->extensions['Cms\Twig\Extension']->themeFilter([0 => "assets/javascript/build/faq.bundle.js"]);
        echo "\"></script>
";
        // line 36
        echo $this->env->getExtension('Cms\Twig\Extension')->endBlock(true        );
    }

    public function getTemplateName()
    {
        return "/var/www/sitefiles/themes/diia/pages/questions.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  129 => 36,  125 => 38,  120 => 37,  118 => 36,  115 => 35,  111 => 34,  103 => 28,  95 => 25,  85 => 21,  77 => 20,  74 => 19,  70 => 18,  64 => 15,  60 => 13,  56 => 12,  48 => 7,  41 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "/var/www/sitefiles/themes/diia/pages/questions.htm", "");
    }
}
