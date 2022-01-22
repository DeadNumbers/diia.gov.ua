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

/* /var/www/sitefiles/themes/diia/pages/medvisnovki.htm */
class __TwigTemplate_9fd817cd2a1212a367142994af55109b9faea59784522009723623ebbad95cff extends \Twig\Template
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
        echo "<div class=\"medv_body\">
\t<div class=\"medv_container\">
\t\t<div class=\"medv_header\">
\t\t\t<div class=\"medv_header-title\">
\t\t\t\t<h1>";
        // line 5
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "data", [], "any", false, false, false, 5), "title", [], "any", false, false, false, 5), "html", null, true);
        echo "</h1>
\t\t\t</div>
\t\t</div>
\t\t<div class=\"medv_content\">
            <form id=\"medv_current_form\">
                <div class=\"medv_step medv_step-one\" id=\"medv_step_one\">
                    <div class=\"medv_form\">
                        <div class=\"row\">
                            <div class=\"col-12\">
                                <div class=\"form-service_input-box medv_input-box js-input-wrap\">
                                    <input
                                        type=\"text\"
                                        name=\"medicDokNumb\"
\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\toninput=\"this.value = this.value.toUpperCase()\"
                                        id=\"num_med_vysn\"
                                        class=\"input form-service_input medv_input-input\"
                                        placeholder=\"Номер медичного висновку про тимчасову непрацездатність\">
\t\t\t\t\t\t\t\t\t<label class=\"medv_input-label\" for=\"num_med_vysn\">Номер медичного висновку</label>
                                    <div class=\"border-gradient\"></div>
\t\t\t\t\t\t\t\t\t<div class=\"medv_input-error\"></div>
                                    <div class=\"medv_input-sublabel\">
                                        ";
        // line 26
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Наприклад, EI29-C69M-XC7E-3O6P"]);
        echo "
                                    </div>
                                </div>
                            </div>

                            <div class=\"col-12\" id=\"formAuthSelect\" style=\"display: none;\">
                                <div class=\"form-service_input-box medv_input-box js-input-wrap medv_input-what\">
                                    <span class=\"medv_input-what--title\">";
        // line 33
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Чий медичний висновок ви шукаєте?"]);
        echo "</span>
                                    <div class=\"medv_input-what--radios\">
                                        <span>
                                            <input type=\"radio\" name=\"WhatMed\" value=\"1\" class=\"inp_radio\" id=\"vysn_my\">
                                            <label for=\"vysn_my\">";
        // line 37
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Свій"]);
        echo "</label>
                                        </span>
                                        <span>
                                            <input type=\"radio\" name=\"WhatMed\" value=\"2\" class=\"inp_radio\" id=\"vysn_ower\">
                                            <label for=\"vysn_ower\">";
        // line 41
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Іншої людини"]);
        echo "</label>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div id=\"medv_vysn_ower\">
\t\t\t\t\t\t\t    <div class=\"col-12\">
\t                                <div class=\"form-service_input-box medv_input-box js-input-wrap medv_input-what\">
\t                                    <span class=\"medv_input-what--title\">";
        // line 50
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Власник медвисновку є громадянином України?"]);
        echo "</span>
\t                                    <div class=\"medv_input-what--radios\">
\t                                        <span>
\t                                            <input type=\"radio\" name=\"identityTypeID\" value=\"1\" class=\"inp_radio\" id=\"vlasn_yes\">
\t                                            <label for=\"vlasn_yes\">";
        // line 54
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Так"]);
        echo "</label>
\t                                        </span>
\t                                        <span>
\t                                            <input type=\"radio\" name=\"identityTypeID\" value=\"7\" class=\"inp_radio\" id=\"vlasn_no\">
\t                                            <label for=\"vlasn_no\">";
        // line 58
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Ні"]);
        echo "</label>
\t                                        </span>
\t                                    </div>
\t                                </div>
\t                            </div>
\t                            <div class=\"col-12 medv_vlasn\" id=\"medv_vlasn_yes\">
\t                                <div class=\"row\">
\t                                    <div class=\"col-12\">
\t                                        <div class=\"form-service_input-box medv_input-box js-input-wrap\">
\t                                            <div class=\"input-border-gradient\">
\t                                                <input type=\"text\" min=\"0\" name=\"rnokpp\" id=\"rnokpp\" class=\"input form-service_input medv_input-input\" placeholder=\"РНОКПП\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"medv_input-label\" for=\"rnokpp\">РНОКПП</label>
\t                                                <div class=\"border-gradient\"></div>
\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"medv_input-error\"></div>
\t                                            </div>
\t                                        </div>
\t                                    </div>

\t                                    <div class=\"col-4 col-md-2\">
\t                                        <div class=\"form-service_input-box medv_input-box js-input-wrap\">
\t                                            <div class=\"input-border-gradient\">
\t                                                <input
\t                                                    type=\"text\"
\t                                                    name=\"series\"
\t                                                    oninput=\"this.value = this.value.toUpperCase()\"
\t                                                    id=\"serial\"
\t                                                    class=\"input input-pas inp_pas form-service_input medv_input-input\"
\t                                                    placeholder=\"Серія\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"medv_input-label\" for=\"serial\">Серія</label>
\t                                                <div class=\"border-gradient\"></div>
\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"medv_input-error\"></div>
\t                                            </div>
\t                                        </div>
\t                                    </div>

\t                                    <div class=\"col-8 col-md-4\">
\t                                        <div class=\"form-service_input-box medv_input-box js-input-wrap\">
\t                                            <div class=\"input-border-gradient\">
\t                                                <input
                                                      type=\"text\"
                                                      name=\"number\"
                                                      id=\"pass_num\"
                                                      class=\"input input-pas inp_pas form-service_input medv_input-input\"
                                                      placeholder=\"Номер паспорта\">
\t\t\t\t\t\t\t\t\t\t\t\t\t  <label class=\"medv_input-label\" for=\"pass_num\">Номер паспорта</label>
\t                                                <div class=\"border-gradient\"></div>
\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"medv_input-error\"></div>
\t                                            </div>
\t                                        </div>
\t                                    </div>

\t                                    <div class=\"col-12 col-md-2\">
\t                                        <div class=\"medv-abo\">
\t                                            ";
        // line 111
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["або"]);
        echo "
\t                                        </div>
\t                                    </div>

\t                                    <div class=\"col-12 col-md-4\">
\t                                        <div class=\"form-service_input-box medv_input-box js-input-wrap\">
\t                                            <div class=\"input-border-gradient\">
\t                                                <input
                                                      type=\"text\"
                                                      name=\"identityDocNumb\"
                                                      id=\"id_card_num\"
                                                      class=\"input input-pasid inp_pas form-service_input medv_input-input\"
                                                      placeholder=\"Номер ID-картки\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"medv_input-label\" for=\"id_card_num\">Номер ID-картки</label>
\t                                                <div class=\"border-gradient\"></div>
\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"medv_input-error\"></div>
\t                                            </div>
\t                                        </div>
\t                                    </div>

\t                                    <div class=\"col-12\">
\t                                        <div class=\"important-info\">";
        // line 132
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["☝ Ви можете шукати за одним або обома параметрами"]);
        echo "</div>
\t                                    </div>
\t                                </div>
\t                            </div>
\t                            <div class=\"col-12 medv_vlasn\" id=\"medv_vlasn_no\">
\t                                <div class=\"row\">
\t                                    <div class=\"col-12\">
\t                                        <div class=\"form-service_input-box medv_input-box js-input-wrap\">
\t                                            <div class=\"input-border-gradient\">
\t                                                <input type=\"text\" name=\"passportTypeID\" id=\"posvid_num\" class=\"input form-service_input medv_input-input\" placeholder=\"Номер посвідки на проживання\">
\t\t\t\t\t\t\t\t\t\t\t\t\t<label class=\"medv_input-label\" for=\"posvid_num\">Номер посвідки на проживання</label>
\t                                                <div class=\"border-gradient\"></div>
\t\t\t\t\t\t\t\t\t\t\t\t\t<div class=\"medv_input-error\"></div>
\t                                            </div>
\t                                        </div>
\t                                    </div>
\t                                </div>
\t                            </div>
                            </div>
                            <div class=\"col-12\">
                                <div class=\"medv_form-captcha\">
                  \t\t\t\t\t<div class=\"form-group\" class=\"field-recaptcha\">
                  \t\t\t\t\t<div class=\"g-recaptcha\"
                                       data-sitekey=\"";
        // line 155
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["reCaptcha"] ?? null), "recaptcha", [], "any", false, false, false, 155), "site_key", [], "any", false, false, false, 155), "html", null, true);
        echo "\"
                                       data-callback='onSubmitReCaptcha'></div>
                  \t\t\t\t\t<script type=\"text/javascript\" src=\"https://www.google.com/recaptcha/api.js?hl=";
        // line 157
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["reCaptcha"] ?? null), "recaptcha", [], "any", false, false, false, 157), "lang", [], "any", false, false, false, 157), "html", null, true);
        echo "\"></script>
                  \t\t\t\t\t</div>
                                </div>
                                <div class=\"medv_input-error\">
                                    <span id=\"recaptchaError\"></span>
                                </div>
                            </div>
                            <div class=\"col-12\">
                                <div class=\"medv_form-send\">
                                    <button class=\"btn_send\" id=\"med_send\">";
        // line 166
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Знайти"]);
        echo "</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div id=\"searchResult\"></div>
                <div id=\"searchResultPDF\" style=\"display: none;\"></div>
                <div class=\"row\" id=\"afterSearch\" style=\"display: none;\">
\t            <div class=\"col-12\">
\t              <div class=\"medv_form-send\">
\t                <button class=\"btn_send\" id=\"med_back\" onclick=\"location.reload();\">Назад до пошуку</button>
\t                <button class=\"btn_send ml-2\" id=\"btnPrint\">Завантажити PDF</button>
\t              </div>
\t            </div>
\t          </div>
            <div class=\"load_wrap\">
                <div class=\"load_more\" id=\"loadMore\" style=\"display: none;\">
                    <span class=\"load_more-text\">";
        // line 185
        echo call_user_func_array($this->env->getFilter('_')->getCallable(), ["Завантажуємо"]);
        echo "</span>
                </div>
            </div>
\t\t</div>
\t</div>
</div>

<script>
    function onSubmitReCaptcha(token) {
        window.medvisnovkiReCaptchaToken = token;
        \$('#recaptchaError').text('');
    }
</script>

";
        // line 199
        echo $this->env->getExtension('Cms\Twig\Extension')->startBlock('scripts'        );
        // line 200
        echo "    <script type=\"text/javascript\" src=\"";
        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/vendor/validate-1.19.1/jquery.validate.min.js");
        echo "\"></script>
    <script type=\"text/javascript\" src=\"";
        // line 201
        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/vendor/mask-1.14.16/jquery.mask.js");
        echo "\"></script>
    <script type=\"text/javascript\" src=\"";
        // line 202
        echo $this->extensions['Cms\Twig\Extension']->themeFilter([0 => "assets/javascript/build/medv.bundle.js"]);
        echo "\"></script>
";
        // line 199
        echo $this->env->getExtension('Cms\Twig\Extension')->endBlock(true        );
    }

    public function getTemplateName()
    {
        return "/var/www/sitefiles/themes/diia/pages/medvisnovki.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  294 => 199,  290 => 202,  286 => 201,  281 => 200,  279 => 199,  262 => 185,  240 => 166,  228 => 157,  223 => 155,  197 => 132,  173 => 111,  117 => 58,  110 => 54,  103 => 50,  91 => 41,  84 => 37,  77 => 33,  67 => 26,  43 => 5,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "/var/www/sitefiles/themes/diia/pages/medvisnovki.htm", "");
    }
}
