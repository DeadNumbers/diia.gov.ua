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

/* /var/www/sitefiles/themes/diia/partials/site/breadcrumbs.htm */
class __TwigTemplate_777dd16633efa795b54152782d7034df9a2635d40ac8435cdb65172e1b23e1f9 extends \Twig\Template
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
        $context["breadcrumbs"] = twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "breadcrumbs", [], "any", false, false, false, 1);
        // line 2
        echo "
";
        // line 3
        if (twig_length_filter($this->env, ($context["breadcrumbs"] ?? null))) {
            // line 4
            echo "<div class=\"container\">
    <div class=\"row\">
        <div class=\"col-12\">
            <nav aria-label=\"breadcrumb\">
                <ul class=\"breadcrumb\">
                    <li class=\"breadcrumb_item\">
                        <a class=\"breadcrumb_item-link\" href=\"";
            // line 10
            echo KitSoft\Core\Twig\UrlFilter::url("/");
            echo "\">";
            echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Головна"]);
            echo "</a>
                    </li>
                    ";
            // line 12
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["breadcrumbs"] ?? null));
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
            foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                // line 13
                echo "                        <li class=\"breadcrumb_item ";
                echo ((twig_get_attribute($this->env, $this->source, $context["loop"], "last", [], "any", false, false, false, 13)) ? ("active") : (""));
                echo "\">
                            ";
                // line 14
                if (twig_get_attribute($this->env, $this->source, $context["loop"], "last", [], "any", false, false, false, 14)) {
                    // line 15
                    echo "                                ";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["this"] ?? null), "page", [], "any", false, false, false, 15), "title", [], "any", false, false, false, 15), "html", null, true);
                    echo "
                            ";
                } else {
                    // line 17
                    echo "                                <a class=\"breadcrumb_item-link\" href=\"";
                    echo KitSoft\Core\Twig\UrlFilter::url(twig_get_attribute($this->env, $this->source, $context["item"], "url", [], "any", false, false, false, 17));
                    echo "\" ";
                    if (twig_get_attribute($this->env, $this->source, $context["item"], "target", [], "any", false, false, false, 17)) {
                        echo "target=\"";
                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "target", [], "any", false, false, false, 17), "html", null, true);
                        echo "\"";
                    }
                    echo ">";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "title", [], "any", false, false, false, 17), "html", null, true);
                    echo "</a>
                            ";
                }
                // line 19
                echo "                        </li>
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
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 21
            echo "                </ul>
            </nav>
        </div>
    </div>
</div>
";
        }
    }

    public function getTemplateName()
    {
        return "/var/www/sitefiles/themes/diia/partials/site/breadcrumbs.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  118 => 21,  103 => 19,  89 => 17,  83 => 15,  81 => 14,  76 => 13,  59 => 12,  52 => 10,  44 => 4,  42 => 3,  39 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "/var/www/sitefiles/themes/diia/partials/site/breadcrumbs.htm", "");
    }
}
