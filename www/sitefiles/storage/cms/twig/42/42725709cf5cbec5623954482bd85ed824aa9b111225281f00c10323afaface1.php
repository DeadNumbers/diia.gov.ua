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

/* /var/www/sitefiles/themes/diia/pages/serviceCategory.htm */
class __TwigTemplate_36fe32b3ee39bb95d79a7fa54f5ac3d569927e22007fffbec30f99e305ab8aea extends \Twig\Template
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
                </ul>
            </nav>
        </div>
    </div>
</div>
";
        // line 16
        echo "
<section>
    <div class=\"container\">
        <div class=\"row\">
            <div class=\"col-12\">
                <h1 class=\"article-level-1\">";
        // line 21
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["serviceCategory"] ?? null), "item", [], "any", false, false, false, 21), "name", [], "any", false, false, false, 21), "html", null, true);
        echo "</h1>
            </div>
        </div>
    </div>
    <!-- services_section -->
    <div class=\"services_section-inner\">
        <div class=\"container\">
            <div class=\"row\">
                ";
        // line 29
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["serviceCategory"] ?? null), "item", [], "any", false, false, false, 29), "subcategories_tree", [], "any", false, false, false, 29));
        foreach ($context['_seq'] as $context["_key"] => $context["subcategory"]) {
            // line 30
            echo "                <div class=\"col-6 col-md-4\">
                    <div class=\"services_item\">
                        ";
            // line 32
            if (twig_get_attribute($this->env, $this->source, $context["subcategory"], "name", [], "any", false, false, false, 32)) {
                // line 33
                echo "                        <a href=\"";
                echo KitSoft\Core\Twig\UrlFilter::url(((twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["serviceCategory"] ?? null), "item", [], "any", false, false, false, 33), "url", [], "any", false, false, false, 33) . "/") . twig_get_attribute($this->env, $this->source, $context["subcategory"], "slug", [], "any", false, false, false, 33)));
                echo "\" class=\"services_item-title-inner\">";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["subcategory"], "name", [], "any", false, false, false, 33), "html", null, true);
                echo "</a>
                        ";
            }
            // line 35
            echo "                        ";
            if (twig_get_attribute($this->env, $this->source, $context["subcategory"], "description", [], "any", false, false, false, 35)) {
                // line 36
                echo "                        <div class=\"services_item-info-inner\">";
                echo twig_get_attribute($this->env, $this->source, $context["subcategory"], "description", [], "any", false, false, false, 36);
                echo "</div>
                        ";
            }
            // line 38
            echo "                    </div>
                </div>
                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['subcategory'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 41
        echo "            </div>
        </div>
    </div>
    <!-- services_section -->
</section>

";
        // line 47
        echo $this->env->getExtension('Cms\Twig\Extension')->startBlock('scripts'        );
        // line 48
        echo "\t<script type=\"text/javascript\" src=\"";
        echo $this->extensions['Cms\Twig\Extension']->themeFilter([0 => "assets/javascript/build/static.bundle.js"]);
        echo "\"></script>
";
        // line 47
        echo $this->env->getExtension('Cms\Twig\Extension')->endBlock(true        );
    }

    public function getTemplateName()
    {
        return "/var/www/sitefiles/themes/diia/pages/serviceCategory.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  125 => 47,  120 => 48,  118 => 47,  110 => 41,  102 => 38,  96 => 36,  93 => 35,  85 => 33,  83 => 32,  79 => 30,  75 => 29,  64 => 21,  57 => 16,  45 => 8,  37 => 2,);
    }

    public function getSourceContext()
    {
        return new Source("", "/var/www/sitefiles/themes/diia/pages/serviceCategory.htm", "");
    }
}
