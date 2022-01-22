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

/* /var/www/sitefiles/themes/diia/pages/taxSystemsChoise.htm */
class __TwigTemplate_bdffe2049c19c406b3b35b375561e0470f4672b81ca59f6a01a4ea08a8264428 extends \Twig\Template
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
        if (twig_length_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["taxSystemChoise"] ?? null), "questions", [], "any", false, false, false, 1))) {
            // line 2
            echo "<section class=\"test-fop_wrap\">
    <div class=\"test-fop_container\">
        <form accept-charset=\"utf-8\" class=\"form form-t-fop\" id=\"form-t-fop\">
            <div class=\"swiper-container\">
                <div class=\"swiper-wrapper\">
                \t<div class=\"swiper-slide\">
                        <div class=\"test-fop_box\">
                            <div class=\"test-fop_view\">
                                <div class=\"test-fop_view-logo\">
                                    <a href=\"/\">
                                        <div class=\"icn-logo_gerb-b\"></div>
                                        <div class=\"icn-logo_diia-b\"></div>
                                    </a>
                                </div>
                                <div class=\"test-fop_view-lead\">";
            // line 16
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "data", [], "any", false, false, false, 16), "title", [], "any", false, false, false, 16), "html", null, true);
            echo "</div>
                                ";
            // line 17
            if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "data", [], "any", false, false, false, 17), "content", [], "any", false, false, false, 17)) {
                // line 18
                echo "                                <div class=\"test-fop_view-sub\">
                                    ";
                // line 19
                echo twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "data", [], "any", false, false, false, 19), "content", [], "any", false, false, false, 19);
                echo "
                                </div>
                                ";
            }
            // line 22
            echo "                                <div class=\"test-fop_view-btn test-fop_view-btn-start\">
                                    <a href=\"/services/reyestraciya-fop\" class=\"btn btn_default\">
                                        <span>";
            // line 24
            echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Назад"]);
            echo "</span>
                                    </a>
                                    <a href=\"javascript:void(0)\" class=\"btn btn-fill btn-start\">";
            // line 26
            echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Почати"]);
            echo "</a>
                                </div>
                            </div>
                        </div>
                    </div>
                \t";
            // line 31
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["taxSystemChoise"] ?? null), "questions", [], "any", false, false, false, 31));
            foreach ($context['_seq'] as $context["_key"] => $context["question"]) {
                // line 32
                echo "\t                    <div class=\"swiper-slide\" ";
                if (twig_get_attribute($this->env, $this->source, $context["question"], "depends_on_option_id", [], "any", false, false, false, 32)) {
                    echo "data-depends-on-option=\"";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["question"], "depends_on_option_id", [], "any", false, false, false, 32), "html", null, true);
                    echo "\"";
                }
                // line 33
                echo "\t\t\t\t\t\t\t";
                if ( !twig_get_attribute($this->env, $this->source, $context["question"], "is_required", [], "any", false, false, false, 33)) {
                    echo "data-required=\"not_required\"";
                }
                echo ">
\t                    \t<input type=\"hidden\" name=\"questions[]\" value=\"";
                // line 34
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["question"], "id", [], "any", false, false, false, 34), "html", null, true);
                echo "\">
\t                        <div class=\"test-fop_box\">
\t                            <div class=\"test-fop_head\">
\t                            \t";
                // line 42
                echo "\t                                <div class=\"col-12 pr-0\">
\t                                    <div class=\"test-fop_head-logo\">
                                            <a href=\"/\">
                                                <div class=\"icn-logo_gerb-b\"></div>
                                                <div class=\"icn-logo_diia-b\"></div>
                                            </a>
\t                                    </div>
\t                                </div>
\t                            </div>
                                ";
                // line 51
                if (twig_get_attribute($this->env, $this->source, $context["question"], "title", [], "any", false, false, false, 51)) {
                    // line 52
                    echo "                                    <div class=\"test-fop_content-lead\">";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["question"], "title", [], "any", false, false, false, 52), "html", null, true);
                    echo "</div>
                                ";
                }
                // line 54
                echo "\t                            <div class=\"test-fop_content\">
\t                            \t";
                // line 55
                if (twig_get_attribute($this->env, $this->source, $context["question"], "description", [], "any", false, false, false, 55)) {
                    // line 56
                    echo "\t                                    <div class=\"test-fop_content-descr\">";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["question"], "description", [], "any", false, false, false, 56), "html", null, true);
                    echo "</div>
\t                                ";
                }
                // line 58
                echo "\t                                <div class=\"form-group\">
\t                                \t";
                // line 59
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["question"], "entrepreneur_options", [], "any", false, false, false, 59));
                foreach ($context['_seq'] as $context["_key"] => $context["option"]) {
                    // line 60
                    echo "\t\t\t\t\t\t\t\t\t\t\t";
                    if ((twig_get_attribute($this->env, $this->source, $context["option"], "type", [], "any", false, false, false, 60) == "option")) {
                        // line 61
                        echo "\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"agree_wrap\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<label for=\"option_";
                        // line 62
                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["option"], "id", [], "any", false, false, false, 62), "html", null, true);
                        echo "\" class=\"agree_wrap-inner\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                        // line 63
                        if ((twig_get_attribute($this->env, $this->source, $context["question"], "type", [], "any", false, false, false, 63) == "radio")) {
                            // line 64
                            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<input class=\"radio\" type=\"radio\" name=\"";
                            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["question"], "input_name", [], "any", false, false, false, 64), "html", null, true);
                            echo "\" id=\"option_";
                            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["option"], "id", [], "any", false, false, false, 64), "html", null, true);
                            echo "\" value=\"";
                            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["option"], "id", [], "any", false, false, false, 64), "html", null, true);
                            echo "\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                        } elseif ((twig_get_attribute($this->env, $this->source,                         // line 65
$context["question"], "type", [], "any", false, false, false, 65) == "checkbox")) {
                            // line 66
                            echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<input class=\"checkbox\" type=\"checkbox\" name=\"";
                            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["question"], "input_name", [], "any", false, false, false, 66), "html", null, true);
                            echo "[]\" id=\"option_";
                            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["option"], "id", [], "any", false, false, false, 66), "html", null, true);
                            echo "\" value=\"";
                            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["option"], "id", [], "any", false, false, false, 66), "html", null, true);
                            echo "\">
\t\t\t\t\t\t\t\t\t\t\t\t\t\t";
                        }
                        // line 68
                        echo "\t\t\t\t\t\t\t\t\t\t\t\t\t\t<label for=\"option_";
                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["option"], "id", [], "any", false, false, false, 68), "html", null, true);
                        echo "\"></label>
\t\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"checkbox_text\">";
                        // line 69
                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["option"], "text", [], "any", false, false, false, 69), "html", null, true);
                        echo "</div>
\t\t\t\t\t\t\t\t\t\t\t\t\t</label>
\t\t\t\t\t\t\t\t\t\t\t\t\t";
                        // line 71
                        if (twig_get_attribute($this->env, $this->source, $context["option"], "description", [], "any", false, false, false, 71)) {
                            // line 72
                            echo "                                                        <div class=\"checkbox_text-alert-wrap\">
                                                            <div class=\"checkbox_text-alert\">";
                            // line 73
                            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["option"], "description", [], "any", false, false, false, 73), "html", null, true);
                            echo "</div>
                                                        </div>
\t\t\t\t\t                                ";
                        }
                        // line 76
                        echo "\t\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t\t";
                    } elseif ((twig_get_attribute($this->env, $this->source,                     // line 77
$context["option"], "type", [], "any", false, false, false, 77) == "label")) {
                        // line 78
                        echo "\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"form-group_title\">";
                        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["option"], "text", [], "any", false, false, false, 78), "html", null, true);
                        echo "</div>
\t\t\t\t\t\t\t\t\t\t\t";
                    }
                    // line 80
                    echo "\t\t\t\t\t\t\t\t\t\t";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['option'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 81
                echo "\t                                </div>
\t                            </div>
\t                            <div class=\"test-fop_view-btn\">
\t                                <a href=\"javascript:void(0)\" class=\"btn btn_default btn-prev\">
\t                                   \t<span>";
                // line 85
                echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Назад"]);
                echo "</span>
\t                                </a>
\t                                <a href=\"javascript:void(0)\" class=\"btn btn-fill btn-next disabled\">";
                // line 87
                echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Далі"]);
                echo "</a>
\t                                ";
                // line 88
                if ( !twig_get_attribute($this->env, $this->source, $context["question"], "is_required", [], "any", false, false, false, 88)) {
                    // line 89
                    echo "\t                                   \t<a href=\"javascript:void(0)\" class=\"btn btn_default btn-next-not-required\">
\t\t                                   \t<span>";
                    // line 90
                    echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Не планую цим займатися "]);
                    echo "</span>
\t\t                                </a>
\t\t                            ";
                }
                // line 93
                echo "\t                                ";
                // line 100
                echo "\t                            </div>
\t                        </div>
\t                    </div>
                    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['question'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 104
            echo "                </div>
            </div>
            <div class=\"form-t-fop_preloader\">
                <div class=\"form-t-fop_preloader-svg\"></div>
            </div>
        </form>
    </div>
</section>
";
        }
        // line 113
        echo "<!-- Modal Error Get Result Test -->
<div class=\"modal modal-service fade\" id=\"ModalError\" tabindex=\"-1\" role=\"dialog\" aria-hidden=\"true\">
    <div class=\"modal-dialog modal-service_dialog\" role=\"document\">
        <div class=\"modal-content modal-service_content\">
            <div class=\"modal-service_close icn_modal-close-service\" data-dismiss=\"modal\" aria-label=\"Close\"></div>
            <div class=\"modal-service_body\">
                <div class=\"modal-service_error\">
                    ";
        // line 120
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Потрібно заповнити хоч одне поле"]);
        echo "
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal Error Get Result Test -->
";
        // line 127
        echo $this->env->getExtension('Cms\Twig\Extension')->startBlock('scripts'        );
        // line 128
        echo "\t<script type=\"text/javascript\" src=\"";
        echo $this->extensions['Cms\Twig\Extension']->themeFilter([0 => "assets/javascript/build/testFop.bundle.js"]);
        echo "\"></script>
";
        // line 127
        echo $this->env->getExtension('Cms\Twig\Extension')->endBlock(true        );
    }

    public function getTemplateName()
    {
        return "/var/www/sitefiles/themes/diia/pages/taxSystemsChoise.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  293 => 127,  288 => 128,  286 => 127,  276 => 120,  267 => 113,  256 => 104,  247 => 100,  245 => 93,  239 => 90,  236 => 89,  234 => 88,  230 => 87,  225 => 85,  219 => 81,  213 => 80,  207 => 78,  205 => 77,  202 => 76,  196 => 73,  193 => 72,  191 => 71,  186 => 69,  181 => 68,  171 => 66,  169 => 65,  160 => 64,  158 => 63,  154 => 62,  151 => 61,  148 => 60,  144 => 59,  141 => 58,  135 => 56,  133 => 55,  130 => 54,  124 => 52,  122 => 51,  111 => 42,  105 => 34,  98 => 33,  91 => 32,  87 => 31,  79 => 26,  74 => 24,  70 => 22,  64 => 19,  61 => 18,  59 => 17,  55 => 16,  39 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "/var/www/sitefiles/themes/diia/pages/taxSystemsChoise.htm", "");
    }
}
