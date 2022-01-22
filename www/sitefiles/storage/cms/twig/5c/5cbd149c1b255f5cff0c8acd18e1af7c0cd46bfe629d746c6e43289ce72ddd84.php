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

/* /var/www/sitefiles/themes/diia/partials/poll/form.htm */
class __TwigTemplate_f7505ff3c1131d62b0eb3f239433a6002c178f8b4ac08fd164e6548d64fc5a47 extends \Twig\Template
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
        $context["question"] = ((twig_get_attribute($this->env, $this->source, ($context["__SELF__"] ?? null), "option", [], "any", false, false, false, 1)) ? (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["__SELF__"] ?? null), "option", [], "any", false, false, false, 1), "question", [], "any", false, false, false, 1)) : (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["__SELF__"] ?? null), "poll", [], "any", false, false, false, 1), "question", [], "any", false, false, false, 1)));
        // line 2
        echo "
<div class=\"form-poll_wrap\">
<form 
    data-request=\"onAnswerPoll\"
    data-request-validate
    data-request-update=\"'@step': '#poll-form-step'\" 
    data-request-success=\"\$('.custom_select').chosen({disable_search: true});\"
    id=\"smartReguestForm\" 
    class=\"form-poll\">
    <input type=\"hidden\" name=\"step\" value=\"";
        // line 11
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["__SELF__"] ?? null), "step", [], "any", false, false, false, 11), "html", null, true);
        echo "\">
    <input type=\"hidden\" name=\"log\" value=\"";
        // line 12
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["__SELF__"] ?? null), "log", [], "any", false, false, false, 12), "html", null, true);
        echo "\">
    <div class=\"form-poll_content\">
        <div class=\"form-poll_content-lead\">";
        // line 14
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["question"] ?? null), "title", [], "any", false, false, false, 14), "html", null, true);
        echo "</div>
            ";
        // line 15
        if ((twig_get_attribute($this->env, $this->source, ($context["question"] ?? null), "type", [], "any", false, false, false, 15) == "select")) {
            // line 16
            echo "                <select name=\"option_ids[]\" class=\"custom_select\">
                    ";
            // line 17
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["question"] ?? null), "options", [], "any", false, false, false, 17));
            foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                // line 18
                echo "                        <option value=\"";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "id", [], "any", false, false, false, 18), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "text", [], "any", false, false, false, 18), "html", null, true);
                echo "</option>
                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 20
            echo "                </select>
                ";
            // line 21
            if (twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "comment", [], "any", false, false, false, 21)) {
                // line 22
                echo "                    <textarea 
                        id=\"option_";
                // line 23
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "id", [], "any", false, false, false, 23), "html", null, true);
                echo "_comment\" 
                        class=\"d-none js-textarea\" 
                        type=\"text\" 
                        name=\"comments[";
                // line 26
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "id", [], "any", false, false, false, 26), "html", null, true);
                echo "]\" 
                        placeholder=\"";
                // line 27
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["item"] ?? null), "comment_placeholder", [], "any", false, false, false, 27), "html", null, true);
                echo "\">
                    </textarea>
                ";
            }
            // line 30
            echo "            ";
        } elseif ((twig_get_attribute($this->env, $this->source, ($context["question"] ?? null), "type", [], "any", false, false, false, 30) == "radio")) {
            // line 31
            echo "                ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["question"] ?? null), "options", [], "any", false, false, false, 31));
            foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                // line 32
                echo "                    <div class=\"agree_wrap\">
                        <label for=\"option_";
                // line 33
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "id", [], "any", false, false, false, 33), "html", null, true);
                echo "\" class=\"agree_wrap-inner\">
                            <input id=\"option_";
                // line 34
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "id", [], "any", false, false, false, 34), "html", null, true);
                echo "\" class=\"radio\" type=\"radio\" name=\"option_ids[]\" value=\"";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "id", [], "any", false, false, false, 34), "html", null, true);
                echo "\">
                            <label for=\"option_";
                // line 35
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "id", [], "any", false, false, false, 35), "html", null, true);
                echo "\"></label>
                            <div class=\"checkbox_text\">";
                // line 36
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "text", [], "any", false, false, false, 36), "html", null, true);
                echo "</div>
                        </label>
                        ";
                // line 38
                if (twig_get_attribute($this->env, $this->source, $context["item"], "comment", [], "any", false, false, false, 38)) {
                    // line 39
                    echo "                            <textarea 
                                id=\"option_";
                    // line 40
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "id", [], "any", false, false, false, 40), "html", null, true);
                    echo "_comment\" 
                                class=\"d-none js-textarea\" 
                                type=\"text\" 
                                name=\"comments[";
                    // line 43
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "id", [], "any", false, false, false, 43), "html", null, true);
                    echo "]\"
                                minlength=\"0\"
                                maxLength=\"1024\"
                                placeholder=\"";
                    // line 46
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "comment_placeholder", [], "any", false, false, false, 46), "html", null, true);
                    echo "\"></textarea>
                        ";
                }
                // line 48
                echo "                    </div>
                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 50
            echo "            ";
        } elseif ((twig_get_attribute($this->env, $this->source, ($context["question"] ?? null), "type", [], "any", false, false, false, 50) == "checkbox")) {
            // line 51
            echo "                ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["question"] ?? null), "options", [], "any", false, false, false, 51));
            foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                // line 52
                echo "                    <div class=\"agree_wrap\">
                        <label for=\"option_";
                // line 53
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "id", [], "any", false, false, false, 53), "html", null, true);
                echo "\" class=\"agree_wrap-inner\">
                            <input id=\"option_";
                // line 54
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "id", [], "any", false, false, false, 54), "html", null, true);
                echo "\" class=\"checkbox\" type=\"checkbox\" name=\"option_ids[]\" value=\"";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "id", [], "any", false, false, false, 54), "html", null, true);
                echo "\">
                            <label for=\"option_";
                // line 55
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "id", [], "any", false, false, false, 55), "html", null, true);
                echo "\"></label>
                            <div class=\"checkbox_text\">";
                // line 56
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "text", [], "any", false, false, false, 56), "html", null, true);
                echo "</div>
                        </label>
                        ";
                // line 58
                if (twig_get_attribute($this->env, $this->source, $context["item"], "comment", [], "any", false, false, false, 58)) {
                    // line 59
                    echo "                            <textarea 
                                id=\"option_";
                    // line 60
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "id", [], "any", false, false, false, 60), "html", null, true);
                    echo "_comment\" 
                                class=\"d-none js-textarea\" 
                                type=\"text\" 
                                name=\"comments[";
                    // line 63
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "id", [], "any", false, false, false, 63), "html", null, true);
                    echo "]\" 
                                minlength=\"0\"
                                maxLength=\"1024\"
                                placeholder=\"";
                    // line 66
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "comment_placeholder", [], "any", false, false, false, 66), "html", null, true);
                    echo "\"></textarea>
                        ";
                }
                // line 68
                echo "                    </div>
                ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 70
            echo "            ";
        }
        // line 71
        echo "    </div>
    <div data-validate-error class=\"error_validation\"></div>
</form>

<button class=\"btn btn-fill\" form=\"smartReguestForm\">";
        // line 75
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Далі"]);
        echo "</button>
";
        // line 76
        if ((twig_get_attribute($this->env, $this->source, ($context["__SELF__"] ?? null), "step", [], "any", false, false, false, 76) > 1)) {
            // line 77
            echo "    <button
        class=\"btn btn-fill\"
        data-request=\"onPollLoad\"
        data-request-update=\"'@default': '#poll'\"
        data-request-success=\"\$('.custom_select').chosen({disable_search: true});\"
    >";
            // line 82
            echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Почати спочатку"]);
            echo "</button>
    <script>
        setTimeout(function() {
            window.inputToggler('smartReguestForm');
        }, 300);
    </script>
";
        }
        // line 89
        echo "</div>";
    }

    public function getTemplateName()
    {
        return "/var/www/sitefiles/themes/diia/partials/poll/form.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  257 => 89,  247 => 82,  240 => 77,  238 => 76,  234 => 75,  228 => 71,  225 => 70,  218 => 68,  213 => 66,  207 => 63,  201 => 60,  198 => 59,  196 => 58,  191 => 56,  187 => 55,  181 => 54,  177 => 53,  174 => 52,  169 => 51,  166 => 50,  159 => 48,  154 => 46,  148 => 43,  142 => 40,  139 => 39,  137 => 38,  132 => 36,  128 => 35,  122 => 34,  118 => 33,  115 => 32,  110 => 31,  107 => 30,  101 => 27,  97 => 26,  91 => 23,  88 => 22,  86 => 21,  83 => 20,  72 => 18,  68 => 17,  65 => 16,  63 => 15,  59 => 14,  54 => 12,  50 => 11,  39 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "/var/www/sitefiles/themes/diia/partials/poll/form.htm", "");
    }
}
