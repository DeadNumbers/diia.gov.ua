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

/* /var/www/sitefiles/themes/diia/partials/menu/footer.htm */
class __TwigTemplate_d6208ed5e5a04893bdfd28366aac40497bd683a4d81eb532b445c07975d53745 extends \Twig\Template
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
        if (twig_length_filter($this->env, ($context["items"] ?? null))) {
            // line 2
            echo "<nav class=\"menu_footer\">
    <ul class=\"menu_footer-list\">
        ";
            // line 4
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["items"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                if ( !twig_get_attribute($this->env, $this->source, $context["item"], "isHidden", [], "any", false, false, false, 4)) {
                    // line 5
                    echo "            <li class=\"menu_footer-list-item\">
                <a href=\"";
                    // line 6
                    echo KitSoft\Core\Twig\UrlFilter::url(twig_get_attribute($this->env, $this->source, $context["item"], "url", [], "any", false, false, false, 6));
                    echo "\" ";
                    if (twig_get_attribute($this->env, $this->source, $context["item"], "isExternal", [], "any", false, false, false, 6)) {
                        echo "target=\"_blank\" ";
                    }
                    echo " class=\"menu_footer-list-link\">";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "title", [], "any", false, false, false, 6), "html", null, true);
                    echo "</a>
            </li>
        ";
                }
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 9
            echo "    </ul>
</nav>
";
        }
    }

    public function getTemplateName()
    {
        return "/var/www/sitefiles/themes/diia/partials/menu/footer.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  67 => 9,  51 => 6,  48 => 5,  43 => 4,  39 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "/var/www/sitefiles/themes/diia/partials/menu/footer.htm", "");
    }
}
