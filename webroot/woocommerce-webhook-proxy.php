<?php
// woocommerce webhook can nt be set for sending additional headers needed for digest authentication
// this proxy adds them to the call

// woocommerce webhook sends out the following HTTP package
/*
Request :

[Method] => POST
[Headers] => Array
    (
        [User-Agent] => WooCommerce/3.7.0 Hookshot (WordPress/5.2.3)
        [Content-Type] => application/json
        [X-WC-Webhook-Source] => http://localhost/~rrd/woo/
        [X-WC-Webhook-Topic] => order.created
        [X-WC-Webhook-Resource] => order
        [X-WC-Webhook-Event] => created
        [X-WC-Webhook-Signature] => VvBj4wWiAIaBUgr49aeJNlzBblH75fVupDZiHV5URoY=
        [X-WC-Webhook-ID] => 1
        [X-WC-Webhook-Delivery-ID] => 8bf7e970e0317310f25d18d5a1eee187
    )

)

[Body] => {
    "id":1400,
    "parent_id":0,
    "number":"1400",
    "order_key":"wc_order_xU41uZ943xSPg",
    "created_via":"admin",
    "version":"3.7.0",
    "status":"pending",
    "currency":"HUF",
    "date_created":"2019-10-27T15:29:54",
    "date_created_gmt":"2019-10-27T15:29:54",
    "date_modified":"2019-10-27T15:30:30",
    "date_modified_gmt":"2019-10-27T15:30:30",
    "discount_total":"0",
    "discount_tax":"0",
    "shipping_total":"0",
    "shipping_tax":"0",
    "cart_tax":"93",
    "total":"1950",
    "total_tax":"93",
    "prices_include_tax":false,
    "customer_id":1,
    "customer_ip_address":"",
    "customer_user_agent":"",
    "customer_note":"",
    "billing":{
        "first_name":"rrd",
        "last_name":"rrd",
        "company":"",
        "address_1":"Sehol u 0",
        "address_2":"MKTHK",
        "city":"Somogyvu00e1mos",
        "state":"",
        "postcode":"8699",
        "country":"HU",
        "email":"rrd@1108.cc",
        "phone":"85540002"
    },
    "shipping":{
        "first_name":"rrd",
        "last_name":"rrd",
        "company":"",
        "address_1":"Gauranga tu00e9r 1",
        "address_2":"MKTHK",
        "city":"Somogyvu00e1mos",
        "state":"",
        "postcode":"8699",
        "country":"HU"
    },
    "payment_method":"",
    "payment_method_title":"",
    "transaction_id":"",
    "date_paid":null,
    "date_paid_gmt":null,
    "date_completed":null,
    "date_completed_gmt":null,
    "cart_hash":"",
    "meta_data":[
        {"id":16996,"key":"_alg_wc_cog_order_profit","value":"897.142857"},
        {"id":16997,"key":"_alg_wc_cog_order_cost","value":"960"},
        {"id":17014,"key":"_GLStrackingNumber","value":""}
    ],
    "line_items":[
        {
            "id":166,
            "name":"Bhagavad-Gita, puha ku00f6tu00e9su0171",
            "product_id":16,
            "variation_id":0,
            "quantity":1,
            "tax_class":"konyv-5",
            "subtotal":"1857",
            "subtotal_tax":"93",
            "total":"1857",
            "total_tax":"93",
            "taxes":[{"id":3,"total":"92.857143","subtotal":"92.857143"}],
            "meta_data":[
                {"id":1244,"key":"_reduced_stock","value":"1"},
                {"id":1251,"key":"_alg_wc_cog_item_cost","value":"960"}
            ],
            "sku":"",
            "price":1857.142857
        }
    ],
    "tax_lines":[{"id":167,"rate_code":"u00c1FA-1","rate_id":3,"label":"u00c1FA","compound":false,"tax_total":"93","shipping_tax_total":"0","rate_percent":5,"meta_data":[]}],"shipping_lines":[],"fee_lines":[],"coupon_lines":[],"refunds":[],"currency_symbol":"Ft","_links":{"self":[{"href":"http://localhost/~rrd/woo/wp-json/wc/v3/orders/1400"}],"collection":[{"href":"http://localhost/~rrd/woo/wp-json/wc/v3/orders"}],"customer":[{"href":"http://localhost/~rrd/woo/wp-json/wc/v3/customers/1"}]}}
*/

// TODO check the hash

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'http://localhost/~rrd/stockR/api/invoices.json');
curl_setopt($ch, CURLOPT_HEADER, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);

// set the addition headers
curl_setopt(
    $ch,
    CURLOPT_HTTPHEADER,
    [
        'Cookie: XDEBUG_SESSION=VSCODE',        // set debug
        'ApiKey: $2y$10$5wpnW/cvYGaiM0kaHG8Sj.9lGduCTs32UaosWwvhsIQX0wqUFuE5C'
    ]
);

// set POST variables in a form that stockR needs them
$items = [];
foreach($_POST['line_items'] as $item) {
    $items[] = [
        'product_name' => $item['name'],        // or use stockRid
        'quantity' => $item['quantity'],
        'price' => $item['price'],
    ];
}
$post = [
    'storage_id' => 5,          // Lál -> Fő u 38
    'invoicetype_id' => 5,      // Belső mozgás
    'partner_id' => 11,         // Webshop
    'date' => $_POST['date_created'] ? $_POST['date_created'] : date('Y-m-d'),
    'number' => 'Woo/Order/' . $_POST['number'],
    'currency' => $_POST['currency'],
    'sale' => true,
    'items' => $items
];

curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));

$response = curl_exec($ch);

$header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
$header = substr($response, 0, $header_size);
$body = substr($response, $header_size);

curl_close($ch);

var_dump($header);
echo '<hr>';
var_dump(json_decode($body));
