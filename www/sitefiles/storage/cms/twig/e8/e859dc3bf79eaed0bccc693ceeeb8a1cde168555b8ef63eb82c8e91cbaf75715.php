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

/* /var/www/sitefiles/themes/diia/partials/site/sections/serviceInfoBlocksColumns.htm */
class __TwigTemplate_e5ac5b8316da89e4ccefa36c495afebb76dd29c781826991056cc930e7ff6ea7 extends \Twig\Template
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
        echo "<section class=\"service-acc_section\">
    <div class=\"container\">
        <div class=\"row\">
            <div class=\"col-12\">
                <div class=\"service-acc_item\">
                    ";
        // line 6
        if (twig_get_attribute($this->env, $this->source, ($context["data"] ?? null), "title", [], "any", false, false, false, 6)) {
            // line 7
            echo "                        <div class=\"service-acc_item-quest js-service-acc_item-quest\">";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["data"] ?? null), "title", [], "any", false, false, false, 7), "html", null, true);
            echo "</div>
                    ";
        }
        // line 9
        echo "                    <div class=\"collapse service-acc_simple-answer\">
                        <div class=\"row\">
                            <div class=\"col-lg-6\">
                                ";
        // line 12
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["data"] ?? null), "primary", [], "any", false, false, false, 12), "items", [], "any", false, false, false, 12));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 13
            echo "                                    <div class=\"service-acc_simple\">
                                        ";
            // line 14
            if (twig_get_attribute($this->env, $this->source, $context["item"], "label", [], "any", false, false, false, 14)) {
                // line 15
                echo "                                        <div class=\"service-acc_simple-label\">
                                            ";
                // line 16
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "label", [], "any", false, false, false, 16), "html", null, true);
                echo "
                                        </div>
                                        ";
            }
            // line 19
            echo "                                        ";
            if (twig_get_attribute($this->env, $this->source, $context["item"], "text", [], "any", false, false, false, 19)) {
                // line 20
                echo "                                        <div class=\"service-acc_simple-text editor-content editor-content_service-acc\">
                                            ";
                // line 21
                echo twig_get_attribute($this->env, $this->source, $context["item"], "text", [], "any", false, false, false, 21);
                echo "
                                        </div>
                                        ";
            }
            // line 24
            echo "                                        ";
            if (twig_get_attribute($this->env, $this->source, KitSoft\Pages\Twig\Filters::relationFinder(twig_get_attribute($this->env, $this->source, $context["item"], "link", [], "any", false, false, false, 24)), "title", [], "any", false, false, false, 24)) {
                // line 25
                echo "                                            <a href=\"";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, KitSoft\Pages\Twig\Filters::relationFinder(twig_get_attribute($this->env, $this->source, $context["item"], "link", [], "any", false, false, false, 25)), "url", [], "any", false, false, false, 25), "html", null, true);
                echo "\" ";
                if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["item"], "link", [], "any", false, false, false, 25), "target", [], "any", false, false, false, 25)) {
                    echo "target=\"_blank\" ";
                }
                echo " class=\"btn_default\">
                                                <span>";
                // line 26
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, KitSoft\Pages\Twig\Filters::relationFinder(twig_get_attribute($this->env, $this->source, $context["item"], "link", [], "any", false, false, false, 26)), "title", [], "any", false, false, false, 26), "html", null, true);
                echo "</span>
                                            </a>
                                        ";
            }
            // line 29
            echo "                                    </div>
                                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 31
        echo "                            </div>
                            <div class=\"col-lg-6\">
                                ";
        // line 33
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["data"] ?? null), "secondary", [], "any", false, false, false, 33), "items", [], "any", false, false, false, 33));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 34
            echo "                                    <div class=\"service-acc_simple\">
                                        ";
            // line 35
            if (twig_get_attribute($this->env, $this->source, $context["item"], "label", [], "any", false, false, false, 35)) {
                // line 36
                echo "                                        <div class=\"service-acc_simple-label\">
                                            ";
                // line 37
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "label", [], "any", false, false, false, 37), "html", null, true);
                echo "
                                        </div>
                                        ";
            }
            // line 40
            echo "                                        ";
            if (twig_get_attribute($this->env, $this->source, $context["item"], "text", [], "any", false, false, false, 40)) {
                // line 41
                echo "                                        <div class=\"service-acc_simple-text editor-content editor-content_service-acc\">
                                            ";
                // line 42
                echo twig_get_attribute($this->env, $this->source, $context["item"], "text", [], "any", false, false, false, 42);
                echo "
                                        </div>
                                        ";
            }
            // line 45
            echo "                                        ";
            if (twig_get_attribute($this->env, $this->source, KitSoft\Pages\Twig\Filters::relationFinder(twig_get_attribute($this->env, $this->source, $context["item"], "link", [], "any", false, false, false, 45)), "title", [], "any", false, false, false, 45)) {
                // line 46
                echo "                                            <a href=\"";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, KitSoft\Pages\Twig\Filters::relationFinder(twig_get_attribute($this->env, $this->source, $context["item"], "link", [], "any", false, false, false, 46)), "url", [], "any", false, false, false, 46), "html", null, true);
                echo "\" ";
                if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, $context["item"], "link", [], "any", false, false, false, 46), "target", [], "any", false, false, false, 46)) {
                    echo "target=\"_blank\" ";
                }
                echo " class=\"btn_default\">
                                                <span>";
                // line 47
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, KitSoft\Pages\Twig\Filters::relationFinder(twig_get_attribute($this->env, $this->source, $context["item"], "link", [], "any", false, false, false, 47)), "title", [], "any", false, false, false, 47), "html", null, true);
                echo "</span>
                                            </a>
                                        ";
            }
            // line 50
            echo "                                    </div>
                                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 52
        echo "                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>";
    }

    public function getTemplateName()
    {
        return "/var/www/sitefiles/themes/diia/partials/site/sections/serviceInfoBlocksColumns.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  171 => 52,  164 => 50,  158 => 47,  149 => 46,  146 => 45,  140 => 42,  137 => 41,  134 => 40,  128 => 37,  125 => 36,  123 => 35,  120 => 34,  116 => 33,  112 => 31,  105 => 29,  99 => 26,  90 => 25,  87 => 24,  81 => 21,  78 => 20,  75 => 19,  69 => 16,  66 => 15,  64 => 14,  61 => 13,  57 => 12,  52 => 9,  46 => 7,  44 => 6,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "/var/www/sitefiles/themes/diia/partials/site/sections/serviceInfoBlocksColumns.htm", "");
    }
}
