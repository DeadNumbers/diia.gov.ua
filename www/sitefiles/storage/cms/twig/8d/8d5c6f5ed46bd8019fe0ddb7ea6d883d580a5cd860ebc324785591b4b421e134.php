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

/* /var/www/sitefiles/themes/diia/partials/site/sections/lifeSituationContent.htm */
class __TwigTemplate_40eb79cce349f881ca78a1276d533f0b486f832dc044710f368faeb81864a9df extends \Twig\Template
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
        echo "<div class=\"row\">
    <div class=\"col-12\">
        <div class=\"life-sit-acc_item\">
            <div class=\"life-sit-acc_item-quest js-life-sit-acc_item-quest\">
                ";
        // line 5
        echo twig_escape_filter($this->env, ($context["title"] ?? null), "html", null, true);
        echo "
            </div>
            <div class=\"collapse life-sit-acc_simple-answer\">
                <div class=\"editor-content editor-content_life-sit\">
                    ";
        // line 9
        echo twig_get_attribute($this->env, $this->source, ($context["data"] ?? null), "content", [], "any", false, false, false, 9);
        echo "
                </div>
                ";
        // line 11
        if (twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["data"] ?? null), "items", [], "any", false, false, false, 11))) {
            // line 12
            echo "                <div class=\"life-sit_repiter-gradient\">
                    <div class=\"life-sit_repiter-container\">
                        ";
            // line 14
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["data"] ?? null), "items", [], "any", false, false, false, 14));
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
                // line 15
                echo "                        <div class=\"life-sit_repiter";
                if (twig_get_attribute($this->env, $this->source, $context["loop"], "first", [], "any", false, false, false, 15)) {
                    echo " first";
                }
                echo "\">
                            ";
                // line 16
                if (twig_get_attribute($this->env, $this->source, $context["item"], "title", [], "any", false, false, false, 16)) {
                    // line 17
                    echo "                            <div class=\"life-sit_repiter-title js-life-sit_repiter-title\">";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "title", [], "any", false, false, false, 17), "html", null, true);
                    echo "</div>
                            ";
                }
                // line 19
                echo "                            ";
                if (twig_get_attribute($this->env, $this->source, $context["item"], "text", [], "any", false, false, false, 19)) {
                    // line 20
                    echo "                            <div class=\"life-sit_repiter-content collapse\">
                                <div class=\"editor-content editor-content_life-sit pb-0\">
                                    ";
                    // line 22
                    echo twig_get_attribute($this->env, $this->source, $context["item"], "text", [], "any", false, false, false, 22);
                    echo "
                                </div>
                            </div>
                            ";
                }
                // line 26
                echo "                        </div>
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
            // line 28
            echo "                    </div>
                </div>
                ";
        }
        // line 31
        echo "            </div>
        </div>
    </div>
</div>";
    }

    public function getTemplateName()
    {
        return "/var/www/sitefiles/themes/diia/partials/site/sections/lifeSituationContent.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  127 => 31,  122 => 28,  107 => 26,  100 => 22,  96 => 20,  93 => 19,  87 => 17,  85 => 16,  78 => 15,  61 => 14,  57 => 12,  55 => 11,  50 => 9,  43 => 5,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "/var/www/sitefiles/themes/diia/partials/site/sections/lifeSituationContent.htm", "");
    }
}
