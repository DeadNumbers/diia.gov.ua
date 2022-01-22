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

/* /var/www/sitefiles/themes/diia/pages/lifeSituation.htm */
class __TwigTemplate_6dbc45f25aac58a75998cc96d014140f0ea8cc8c1c002bc614847f5e97d2b375 extends \Twig\Template
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
        echo "<div class=\"container\">
    <div class=\"row\">
        <div class=\"col-12\">
            <nav aria-label=\"breadcrumb\">
                <ul class=\"breadcrumb\">
                    <li class=\"breadcrumb_item\">
                        <a class=\"breadcrumb_item-link\" href=\"";
        // line 8
        echo KitSoft\Core\Twig\UrlFilter::url("/");
        echo "\">";
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Головна"]);
        echo "</a>
                    </li>
                    ";
        // line 10
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["lifeSituation"] ?? null), "item", [], "any", false, false, false, 10), "parents", [], "any", false, false, false, 10));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 11
            echo "                        <li class=\"breadcrumb_item\">
                            <a class=\"breadcrumb_item-link\" href=\"";
            // line 12
            echo KitSoft\Core\Twig\UrlFilter::url(twig_get_attribute($this->env, $this->source, $context["item"], "url", [], "any", false, false, false, 12));
            echo "\">";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "title", [], "any", false, false, false, 12), "html", null, true);
            echo "</a>
                        </li>
                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 15
        echo "                    <li class=\"breadcrumb_item active\">
                    \t";
        // line 16
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["lifeSituation"] ?? null), "item", [], "any", false, false, false, 16), "title", [], "any", false, false, false, 16), "html", null, true);
        echo "
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>
";
        // line 24
        echo "
";
        // line 25
        if ( !twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["lifeSituation"] ?? null), "item", [], "any", false, false, false, 25), "parent_id", [], "any", false, false, false, 25)) {
            // line 26
            echo "    ";
            $context['__cms_partial_params'] = [];
            echo $this->env->getExtension('Cms\Twig\Extension')->partialFunction("lifeSituation/parent"            , $context['__cms_partial_params']            , true            );
            unset($context['__cms_partial_params']);
        } else {
            // line 28
            echo "    ";
            $context['__cms_partial_params'] = [];
            echo $this->env->getExtension('Cms\Twig\Extension')->partialFunction("lifeSituation/child"            , $context['__cms_partial_params']            , true            );
            unset($context['__cms_partial_params']);
        }
        // line 30
        echo "
";
        // line 31
        echo $this->env->getExtension('Cms\Twig\Extension')->startBlock('scripts'        );
        // line 32
        echo "    <script type=\"text/javascript\" src=\"";
        echo $this->extensions['Cms\Twig\Extension']->themeFilter([0 => "assets/javascript/build/static.bundle.js"]);
        echo "\"></script>
";
        // line 31
        echo $this->env->getExtension('Cms\Twig\Extension')->endBlock(true        );
    }

    public function getTemplateName()
    {
        return "/var/www/sitefiles/themes/diia/pages/lifeSituation.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  110 => 31,  105 => 32,  103 => 31,  100 => 30,  94 => 28,  88 => 26,  86 => 25,  83 => 24,  73 => 16,  70 => 15,  59 => 12,  56 => 11,  52 => 10,  45 => 8,  37 => 2,);
    }

    public function getSourceContext()
    {
        return new Source("", "/var/www/sitefiles/themes/diia/pages/lifeSituation.htm", "");
    }
}
