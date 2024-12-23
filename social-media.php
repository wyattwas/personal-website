<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="The atrocious making of a wild, tech affine, nerdy, human being">
    <meta name="keywords" content="tech, nerd, open-source, open-web, free-software, free, software, web, open">
    <meta name="author" content="wyatt">
    <meta name="theme-color" content="black">
    <title>Recent Posts - @withoutwyatt@wetdry.world</title>
    <link rel="me" href="https://wetdry.world/@withoutwyatt">
    <link rel="license" href="https://creativecommons.org/licenses/by-nc-sa/4.0/">
    <link rel="icon" href="./media/saturn.png">
</head>
<body>
<?php
$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => "https://wetdry.world/api/v1/accounts/112597151362992696/statuses",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
        "cache-control: no-cache"
    ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

$response = json_decode($response, true);

for ($i = 0; $i < 4; $i++): ?>
    <?php if (sizeof($response[$i]['emojis']) > 0) {
        foreach ($response[$i]['emojis'] as $emoji) {
            $response[$i]['content'] = str_replace(':' . $emoji['shortcode'] . ':', '<img src="' . $emoji['url'] . '" alt="' . $emoji['shortcode'] . '" style="max-height: 24px">', $response[$i]['content']);
        }
    } ?>
    <div style="margin: 5px 0 5px 0; border: 1px black solid; padding: 5px">
        <a href="https://wetdry.world/@<?= $response[$i]['account']['username'] ?>" target="_blank"
           style="color: inherit; text-decoration: inherit">
            <div style="display: flex; align-items: center; gap: 10px">
                <img style="height: 50px; width: 50px;" src="<?= $response[$i]['account']['avatar'] ?>"
                     alt="Account Avatar">
                <span style="display: flex; flex-direction: column; gap: 5px">
                            <bdi>
                                <strong><?= $response[$i]['account']['display_name'] ?></strong>
                            </bdi>
                            <span>@<?= $response[$i]['account']['username'] ?>@wetdry.world</span>
                        </span>
            </div>
        </a>
        <a href="<?= $response[$i]['url'] ?>" target="_blank" style="color: inherit; text-decoration: inherit">
            <div>
                <?= $response[$i]['content'] ?>
            </div>
            <?php foreach ($response[$i]['media_attachments'] as $image): ?>
                <img src="<?= $image['url'] ?>" alt="Image" style="max-width: 100%; max-height: 100px">
            <?php endforeach; ?>
        </a>
        <div><?= date('D, d M Y H:i:s', strtotime($response[$i]['created_at'])) ?></div>
    </div>
<?php endfor; ?>
</body>
</html>
