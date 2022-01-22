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

/* /var/www/sitefiles/themes/diia/partials/form/faqForm.htm */
class __TwigTemplate_cca351b9839f00d51b7eec510ee25f51f59b5d728ac76bcbb944c2478899c6bc extends \Twig\Template
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
    <div class=\"container\">
        <div class=\"row\">
            <div class=\"col-12\">
                <div class=\"service_not-found\">
                    <div class=\"service_not-found-title\">
                        ";
        // line 7
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Не знайшли потрібної відповіді? Поставте запитання"]);
        echo "
                    </div>
                    <div class=\"service_not-found-btn\">
                        <a href=\"#\" class=\"btn btn-fill\" data-toggle=\"modal\" data-target=\"#exampleModal\">";
        // line 10
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Поставити запитання"]);
        echo "</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

";
        // line 18
        $context["form"] = twig_get_attribute($this->env, $this->source, ($context["__SELF__"] ?? null), "form", [], "any", false, false, false, 18);
        // line 19
        echo "


<div class=\"modal modal-service fade\" id=\"exampleModal\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">
    <div class=\"modal-dialog modal-service_dialog\" role=\"document\">
        <div class=\"modal-content modal-service_content\">
            <div class=\"modal-service_close icn_modal-close-service\" data-dismiss=\"modal\" aria-label=\"Close\"></div>
            <div class=\"modal-service_body\">
                <form class=\"form form-service\"
                        ";
        // line 34
        echo "                        method=\"POST\"
                        accept-charset=\"utf-8\"
                        id=\"form-faq-item\">

                    <div class=\"modal-service_title\">";
        // line 38
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["form"] ?? null), "name", [], "any", false, false, false, 38), "html", null, true);
        echo "</div>

                    <input type=\"hidden\" name=\"form_id\" value=\"";
        // line 40
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["form"] ?? null), "id", [], "any", false, false, false, 40), "html", null, true);
        echo "\" class=\"ignore\">

                    <div class=\"row\">

                        ";
        // line 44
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_slice($this->env, twig_get_attribute($this->env, $this->source, ($context["form"] ?? null), "fields", [], "any", false, false, false, 44), 0, 2));
        foreach ($context['_seq'] as $context["_key"] => $context["field"]) {
            if ((twig_get_attribute($this->env, $this->source, $context["field"], "type", [], "any", false, false, false, 44) == "text")) {
                // line 45
                echo "
                            <div class=\"col-md-6\">
                                <div class=\"form-service_input-box\">
                                    <div class=\"input-border-gradient\">
                                        <input type=\"text\"
                                               name=\"";
                // line 50
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["field"], "code", [], "any", false, false, false, 50), "html", null, true);
                echo "\"
                                               class=\"input form-service_input\"
                                               placeholder=\"";
                // line 52
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["field"], "placeholder", [], "any", false, false, false, 52), "html", null, true);
                echo "\">
                                        <div class=\"border-gradient\"></div>
                                    </div>
                                </div>
                            </div>

                        ";
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['field'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 59
        echo "
                    </div>

                    ";
        // line 62
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(twig_slice($this->env, twig_get_attribute($this->env, $this->source, ($context["form"] ?? null), "fields", [], "any", false, false, false, 62), 2, 4));
        foreach ($context['_seq'] as $context["_key"] => $context["field"]) {
            if ((twig_get_attribute($this->env, $this->source, $context["field"], "type", [], "any", false, false, false, 62) == "text")) {
                // line 63
                echo "
                        <div class=\"form-service_input-box\">
                            <div class=\"input-border-gradient\">
                                <input type=\"text\"
                                       name=\"";
                // line 67
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["field"], "code", [], "any", false, false, false, 67), "html", null, true);
                echo "\"
                                       class=\"input form-service_input\"
                                       placeholder=\"";
                // line 69
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["field"], "placeholder", [], "any", false, false, false, 69), "html", null, true);
                echo "\">
                                <div class=\"border-gradient\"></div>
                            </div>

                        </div>

                    ";
            }
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['field'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 76
        echo "                    ";
        if (twig_get_attribute($this->env, $this->source, ($context["form"] ?? null), "submit_text", [], "any", false, false, false, 76)) {
            // line 77
            echo "
                        <button class=\"btn btn-fill\" id=\"form-faq-item-btn\">
                            ";
            // line 79
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["form"] ?? null), "submit_text", [], "any", false, false, false, 79), "html", null, true);
            echo "
                        </button>

                    ";
        }
        // line 83
        echo "
                </form>
            </div>
            <div class=\"modal-service_done\">
                <div class=\"modal-service_done-icn\"></div>
                <div class=\"modal-service_done-title\">";
        // line 88
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Дякуємо"]);
        echo "</div>
                <div class=\"modal-service_done-text\">";
        // line 89
        echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["__SELF__"] ?? null), "form", [], "any", false, false, false, 89), "success_text", [], "any", false, false, false, 89);
        echo "</div>
                <div class=\"modal-service_done-btn\">
                    <a href=\"/\" class=\"btn btn_default\"><span>На головну</span></a>
                </div>
            </div>
        </div>
    </div>
</div>";
    }

    public function getTemplateName()
    {
        return "/var/www/sitefiles/themes/diia/partials/form/faqForm.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  184 => 89,  180 => 88,  173 => 83,  166 => 79,  162 => 77,  159 => 76,  145 => 69,  140 => 67,  134 => 63,  129 => 62,  124 => 59,  110 => 52,  105 => 50,  98 => 45,  93 => 44,  86 => 40,  81 => 38,  75 => 34,  64 => 19,  62 => 18,  51 => 10,  45 => 7,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "/var/www/sitefiles/themes/diia/partials/form/faqForm.htm", "");
    }
}
