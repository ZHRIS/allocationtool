<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of Setting
 *
 * @author
 */
class Setting_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function get($id)
    {
        $this->db->from('setting');
        $this->db->where('setting_id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    public function get_list()
    {
        $query = $this->db->get('setting');
        return $query->result();
    }

    public function save_last_allocation($count)
    {
        $data = array('errors_found' => $count);
        $this->db->where('setting_id', $this->get_setting()->setting_id);
        $this->db->update('setting', $data);
    }

    public function save_last_run_date()
    {
        $datetime = date_create()->format('Y-m-d H:i:s');
        $data = array('date_modified' => $datetime);
        $this->db->where('setting_id', $this->get_setting()->setting_id);
        $this->db->update('setting', $data);
    }

    public function save()
    {
        $this->platform = $this->input->post('platform');
        $this->maximum_running_time = $this->input->post('maximum_running_time');
        $this->optimality_gap = $this->input->post('optimality_gap');
        $this->harvesine_formula = $this->input->post('harvesine_formula');
        $this->maximum_weight = $this->input->post('maximum_weight');
        $this->total_budget = $this->input->post('total_budget');
        $this->default_penalty_unfulfilled_demand = $this->input->post('default_penalty_unfulfilled_demand');
        $this->number_of_preferences_allowed = $this->input->post('number_of_preferences_allowed');
        $this->tool_currency = $this->input->post('tool_currency');
        $this->db->insert('setting', $this);
    }

    public function update($id)
    {
        $this->platform = $this->input->post('platform');
        $this->maximum_running_time = $this->input->post('maximum_running_time');
        $this->optimality_gap = $this->input->post('optimality_gap');
        $this->harvesine_formula = $this->input->post('harvesine_formula');
        $this->maximum_weight = $this->input->post('maximum_weight');
        $this->total_budget = $this->input->post('total_budget');
        $this->default_penalty_unfulfilled_demand = $this->input->post('default_penalty_unfulfilled_demand');
        $this->number_of_preferences_allowed = $this->input->post('number_of_preferences_allowed');
        $this->tool_currency = $this->input->post('tool_currency');
        $this->db->where('setting_id', $id);
        $this->db->update('setting', $this);
    }

    function delete($id)
    {
        $this->db->where('setting_id', $id);
        $this->db->delete('setting');
    }

    function get_row_count()
    {
        return $this->db->count_all('setting');
    }

    public function get_setting()
    {
        $this->db->from('setting', 1);
        $query = $this->db->get();
        return $query->row();
    }

    public function get_default_penalty_unfulfilled_demand()
    {
        $setting = $this->get_setting();
        if (is_null($setting)) {
            return 40;
        } else {
            return $setting->default_penalty_unfulfilled_demand;
        }
    }

    public function get_number_of_preferences_allowed()
    {
        $setting = $this->get_setting();
        if (is_null($setting)) {
            return 3;
        } else {
            return $setting->number_of_preferences_allowed;
        }
    }

    public function get_total_budget_value()
    {
        $setting = $this->get_setting();
        if ($setting->total_budget == 0) {
            return "NA";
        } else {
            return $setting->total_budget;
        }
    }

    public function get_last_modified_date()
    {
        $setting = $this->get_setting();
        if (is_null($setting)) {
            return "NA";
        }
        if (is_null($setting->date_modified)) {
            return "NA";
        } else {
            return $setting->date_modified;
        }
    }

    public function has_allocation_tool_errors()
    {
        $setting = $this->get_setting();
        if (is_null($setting)) {
            return "NA";
        }
        $errors = $setting->errors_found;
        if (is_null($errors)) {
            return "NA";
        } else if ($errors > 0) {
            return "Errors Found * " . $errors;
        } else {
            return "NA";
        }
    }


    function get_total_count()
    {
        $this->db->distinct();
        return $this->db->count_all('setting');
    }


    function get_currencies_dropdown()
    {
        $_id = array('-SELECT-');
        $_name = array('-SELECT-');
        $currencies = array("AFA" => "Afghani", "AFN" => "Afghani", "ALK" => "Albanian old lek", "ALL" => "Lek", "DZD" => "Algerian Dinar", "USD" => "US Dollar", "ADF" => "Andorran Franc", "ADP" => "Andorran Peseta", "EUR" => "Euro", "AOR" => "Angolan Kwanza Readjustado", "AON" => "Angolan New Kwanza", "AOA" => "Kwanza", "XCD" => "East Caribbean Dollar", "ARA" => "Argentine austral", "ARS" => "Argentine Peso", "ARL" => "Argentine peso ley", "ARM" => "Argentine peso moneda nacional", "ARP" => "Peso argentino", "AMD" => "Armenian Dram", "AWG" => "Aruban Guilder", "AUD" => "Australian Dollar", "ATS" => "Austrian Schilling", "AZM" => "Azerbaijani manat", "AZN" => "Azerbaijanian Manat", "BSD" => "Bahamian Dollar", "BHD" => "Bahraini Dinar", "BDT" => "Taka", "BBD" => "Barbados Dollar", "BYR" => "Belarussian Ruble", "BEC" => "Belgian Franc (convertible)", "BEF" => "Belgian Franc (currency union with LUF)", "BEL" => "Belgian Franc (financial)", "BZD" => "Belize Dollar", "XOF" => "CFA Franc BCEAO", "BMD" => "Bermudian Dollar", "INR" => "Indian Rupee", "BTN" => "Ngultrum", "BOP" => "Bolivian peso", "BOB" => "Boliviano", "BOV" => "Mvdol", "BAM" => "Convertible Marks", "BWP" => "Pula", "NOK" => "Norwegian Krone", "BRC" => "Brazilian cruzado", "BRB" => "Brazilian cruzeiro", "BRL" => "Brazilian Real", "BND" => "Brunei Dollar", "BGN" => "Bulgarian Lev", "BGJ" => "Bulgarian lev A/52", "BGK" => "Bulgarian lev A/62", "BGL" => "Bulgarian lev A/99", "BIF" => "Burundi Franc", "KHR" => "Riel", "XAF" => "CFA Franc BEAC", "CAD" => "Canadian Dollar", "CVE" => "Cape Verde Escudo", "KYD" => "Cayman Islands Dollar", "CLP" => "Chilean Peso", "CLF" => "Unidades de fomento", "CNX" => "Chinese People's Bank dollar", "CNY" => "Yuan Renminbi", "COP" => "Colombian Peso", "COU" => "Unidad de Valor real", "KMF" => "Comoro Franc", "CDF" => "Franc Congolais", "NZD" => "New Zealand Dollar", "CRC" => "Costa Rican Colon", "HRK" => "Croatian Kuna", "CUP" => "Cuban Peso", "CYP" => "Cyprus Pound", "CZK" => "Czech Koruna", "CSK" => "Czechoslovak koruna", "CSJ" => "Czechoslovak koruna A/53", "DKK" => "Danish Krone", "DJF" => "Djibouti Franc", "DOP" => "Dominican Peso", "ECS" => "Ecuador sucre", "EGP" => "Egyptian Pound", "SVC" => "Salvadoran col�n", "EQE" => "Equatorial Guinean ekwele", "ERN" => "Nakfa", "EEK" => "Kroon", "ETB" => "Ethiopian Birr", "FKP" => "Falkland Island Pound", "FJD" => "Fiji Dollar", "FIM" => "Finnish Markka", "FRF" => "French Franc", "XFO" => "Gold-Franc", "XPF" => "CFP Franc", "GMD" => "Dalasi", "GEL" => "Lari", "DDM" => "East German Mark of the GDR (East Germany)", "DEM" => "Deutsche Mark", "GHS" => "Ghana Cedi", "GHC" => "Ghanaian cedi", "GIP" => "Gibraltar Pound", "GRD" => "Greek Drachma", "GTQ" => "Quetzal", "GNF" => "Guinea Franc", "GNE" => "Guinean syli", "GWP" => "Guinea-Bissau Peso", "GYD" => "Guyana Dollar", "HTG" => "Gourde", "HNL" => "Lempira", "HKD" => "Hong Kong Dollar", "HUF" => "Forint", "ISK" => "Iceland Krona", "ISJ" => "Icelandic old krona", "IDR" => "Rupiah", "IRR" => "Iranian Rial", "IQD" => "Iraqi Dinar", "IEP" => "Irish Pound (Punt in Irish language)", "ILP" => "Israeli lira", "ILR" => "Israeli old sheqel", "ILS" => "New Israeli Sheqel", "ITL" => "Italian Lira", "JMD" => "Jamaican Dollar", "JPY" => "Yen", "JOD" => "Jordanian Dinar", "KZT" => "Tenge", "KES" => "Kenyan Shilling", "KPW" => "North Korean Won", "KRW" => "Won", "KWD" => "Kuwaiti Dinar", "KGS" => "Som", "LAK" => "Kip", "LAJ" => "Lao kip", "LVL" => "Latvian Lats", "LBP" => "Lebanese Pound", "LSL" => "Loti", "ZAR" => "Rand", "LRD" => "Liberian Dollar", "LYD" => "Libyan Dinar", "CHF" => "Swiss Franc", "LTL" => "Lithuanian Litas", "LUF" => "Luxembourg Franc (currency union with BEF)", "MOP" => "Pataca", "MKD" => "Denar", "MKN" => "Former Yugoslav Republic of Macedonia denar A/93", "MGA" => "Malagasy Ariary", "MGF" => "Malagasy franc", "MWK" => "Kwacha", "MYR" => "Malaysian Ringgit", "MVQ" => "Maldive rupee", "MVR" => "Rufiyaa", "MAF" => "Mali franc", "MTL" => "Maltese Lira", "MRO" => "Ouguiya", "MUR" => "Mauritius Rupee", "MXN" => "Mexican Peso", "MXP" => "Mexican peso", "MXV" => "Mexican Unidad de Inversion (UDI)", "MDL" => "Moldovan Leu", "MCF" => "Monegasque franc (currency union with FRF)", "MNT" => "Tugrik", "MAD" => "Moroccan Dirham", "MZN" => "Metical", "MZM" => "Mozambican metical", "MMK" => "Kyat", "NAD" => "Namibia Dollar", "NPR" => "Nepalese Rupee", "NLG" => "Netherlands Guilder", "ANG" => "Netherlands Antillian Guilder", "NIO" => "Cordoba Oro", "NGN" => "Naira", "OMR" => "Rial Omani", "PKR" => "Pakistan Rupee", "PAB" => "Balboa", "PGK" => "Kina", "PYG" => "Guarani", "YDD" => "South Yemeni dinar", "PEN" => "Nuevo Sol", "PEI" => "Peruvian inti", "PEH" => "Peruvian sol", "PHP" => "Philippine Peso", "PLZ" => "Polish zloty A/94", "PLN" => "Zloty", "PTE" => "Portuguese Escudo", "TPE" => "Portuguese Timorese escudo", "QAR" => "Qatari Rial", "RON" => "New Leu", "ROL" => "Romanian leu A/05", "ROK" => "Romanian leu A/52", "RUB" => "Russian Ruble", "RWF" => "Rwanda Franc", "SHP" => "Saint Helena Pound", "WST" => "Tala", "STD" => "Dobra", "SAR" => "Saudi Riyal", "RSD" => "Serbian Dinar", "CSD" => "Serbian Dinar", "SCR" => "Seychelles Rupee", "SLL" => "Leone", "SGD" => "Singapore Dollar", "SKK" => "Slovak Koruna", "SIT" => "Slovenian Tolar", "SBD" => "Solomon Islands Dollar", "SOS" => "Somali Shilling", "ZAL" => "South African financial rand (Funds code) (discont", "ESP" => "Spanish Peseta", "ESA" => "Spanish peseta (account A)", "ESB" => "Spanish peseta (account B)", "LKR" => "Sri Lanka Rupee", "SDD" => "Sudanese Dinar", "SDP" => "Sudanese Pound", "SDG" => "Sudanese Pound", "SRD" => "Surinam Dollar", "SRG" => "Suriname guilder", "SZL" => "Lilangeni", "SEK" => "Swedish Krona", "CHE" => "WIR Euro", "CHW" => "WIR Franc", "SYP" => "Syrian Pound", "TWD" => "New Taiwan Dollar", "TJS" => "Somoni", "TJR" => "Tajikistan ruble", "TZS" => "Tanzanian Shilling", "THB" => "Baht", "TOP" => "Pa'anga", "TTD" => "Trinidata and Tobago Dollar", "TND" => "Tunisian Dinar", "TRY" => "New Turkish Lira", "TRL" => "Turkish lira A/05", "TMM" => "Manat", "RUR" => "Russian rubleA/97", "SUR" => "Soviet Union ruble", "UGX" => "Uganda Shilling", "UGS" => "Ugandan shilling A/87", "UAH" => "Hryvnia", "UAK" => "Ukrainian karbovanets", "AED" => "UAE Dirham", "GBP" => "Pound Sterling", "USN" => "US Dollar (Next Day)", "USS" => "US Dollar (Same Day)", "UYU" => "Peso Uruguayo", "UYN" => "Uruguay old peso", "UYI" => "Uruguay Peso en Unidades Indexadas", "UZS" => "Uzbekistan Sum", "VUV" => "Vatu", "VEF" => "Bolivar Fuerte", "VEB" => "Venezuelan Bolivar", "VND" => "Dong", "VNC" => "Vietnamese old dong", "YER" => "Yemeni Rial", "YUD" => "Yugoslav Dinar", "YUM" => "Yugoslav dinar (new)", "ZRN" => "Zairean New Zaire", "ZRZ" => "Zairean Zaire", "ZMK" => "Kwacha");
        foreach (array_keys($currencies) as $value) {
            array_push($_id, $value);
        }
        foreach (array_values($currencies) as $value) {
            array_push($_name, $value);
        }
        return $list_result = array_combine($_id, $_name);
    }

    public function get_tool_currency()
    {
        $setting = $this->get_setting();
        return $setting->tool_currency;
    }

    public function get_total_demand_locations_budget()
    {
        if (!is_numeric($this->get_total_budget_value())) {
            return 0;
        }
        return $this->get_total_budget_value();
    }

    function get_platform_dropdown()
    {
        $_id = array('-SELECT-');
        $_name = array('-SELECT-');
        array_push($_id, 'Linux');
        array_push($_name, 'Linux');
        array_push($_id, 'Windows');
        array_push($_name, 'Windows');
        return $list_result = array_combine($_id, $_name);
    }

    public function get_os_platform()
    {
        $setting = $this->get_setting();
        if ($setting->platform == 0) {
            return "NA";
        } else {
            return $setting->platform;
        }
    }

}
