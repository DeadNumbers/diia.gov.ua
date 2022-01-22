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

/* /var/www/sitefiles/themes/diia/partials/posts/default.htm */
class __TwigTemplate_2714cfbe2300cf03bf2a1f10d67bc2517010340ac6d29f1c989eafe6216d708c extends \Twig\Template
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
        echo "<section>
    <div class=\"container\" id=\"posts-container\">
        <div class=\"row\">
            <div class=\"col-12\">
                <h1 class=\"article-level-1\">
                    ";
        // line 6
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "data", [], "any", false, false, false, 6), "title", [], "any", false, false, false, 6), "html", null, true);
        echo "
                </h1>
            </div>
        </div>
        <div class=\"row\" id=\"posts-items-box\">
            ";
        // line 11
        $context['__cms_partial_params'] = [];
        echo $this->env->getExtension('Cms\Twig\Extension')->partialFunction("posts/items"        , $context['__cms_partial_params']        , true        );
        unset($context['__cms_partial_params']);
        // line 12
        echo "        </div>
    </div>
    ";
        // line 14
        if ((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["__SELF__"] ?? null), "posts", [], "any", false, false, false, 14), "currentPage", [], "any", false, false, false, 14) < twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["__SELF__"] ?? null), "posts", [], "any", false, false, false, 14), "lastPage", [], "any", false, false, false, 14))) {
            // line 15
            echo "        <div class=\"container\">
            <div class=\"row justify-content-center\">
                <div class=\"col-lg-4\">
                    <a href=\"javascript:void(0)\" class=\"btn btn_more-news\" id=\"btn_more-news\">";
            // line 18
            echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Більше новин"]);
            echo "</a>
                </div>
            </div>
        </div>
    ";
        }
        // line 23
        echo "</section>
<section>
    <nav aria-label=\"post page navigation\" id=\"post-navigation\">
        ";
        // line 26
        echo twig_get_attribute($this->env, $this->source, ($context["__SELF__"] ?? null), "posts", [], "any", false, false, false, 26);
        echo "
    </nav>
</section>";
    }

    public function getTemplateName()
    {
        return "/var/www/sitefiles/themes/diia/partials/posts/default.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  80 => 26,  75 => 23,  67 => 18,  62 => 15,  60 => 14,  56 => 12,  52 => 11,  44 => 6,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "/var/www/sitefiles/themes/diia/partials/posts/default.htm", "");
    }
}
