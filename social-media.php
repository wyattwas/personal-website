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
    <style>
        body {
            & > div {
                padding: 5px 8px;
            }

            & > div:nth-child(odd) {
                background-color: #e6e6e6;
            }
        }
    </style>
</head>
<body style="margin: 0">
<div style="padding: 10px; position: sticky; top: 0; background-color: black; color: white; display: flex; justify-content: space-between">
    Quacks from me
    <a href="https://wetdry.world/@withoutwyatt" style="color: white">Visit my social media page</a>
</div>
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
    <?php if ($response[$i]['reblog'] != null) : ?>
        <div>
            <a href="<?= $response[$i]['account']['url'] ?>" target="_blank"
               style="color: inherit; text-decoration: inherit">
                <div style="display: flex; align-items: center; gap: 10px">
                    <span style="display: flex; flex-direction: column; gap: 5px; font-size: smaller">
                        <strong>
                            <svg xmlns="http://www.w3.org/2000/svg" height="15" viewBox="0 -960 960 960" width="15"
                                 class="icon icon-retweet" aria-hidden="true">
                                <path d="M280-80 120-240l160-160 56 58-62 62h406v-160h80v240H274l62 62-56 58Zm-80-440v-240h486l-62-62 56-58 160 160-160 160-56-58 62-62H280v160h-80Z"></path>
                            </svg>
                            <?= $response[$i]['account']['display_name'] ?> boosted
                        </strong>
                    </span>
                </div>
            </a>
            <a href="<?= $response[$i]['reblog']['account']['url'] ?>" target="_blank"
               style="color: inherit; text-decoration: inherit">
                <div style="display: flex; align-items: center; gap: 10px">
                    <img style="height: 50px; width: 50px;"
                         src="<?= $response[$i]['reblog']['account']['avatar'] ?>"
                         alt="Account Avatar">
                    <span style="display: flex; flex-direction: column; gap: 5px">
                            <bdi>
                                <strong><?= $response[$i]['reblog']['account']['display_name'] ?></strong>
                            </bdi>
                            <span>@<?= $response[$i]['reblog']['account']['username'] ?>@<?php
                                preg_match('/https?:\/\/([^\/]+)/', $response[$i]['reblog']['account']['url'], $matches);
                                echo $matches[1];
                                ?></span>
                        </span>
                </div>
            </a>
            <a href="<?= $response[$i]['reblog']['url'] ?>" target="_blank"
               style="color: inherit; text-decoration: inherit">
                <div>
                    <?= $response[$i]['reblog']['content'] ?>
                </div>
                <?php foreach ($response[$i]['reblog']['media_attachments'] as $image): ?>
                    <img src="<?= $image['url'] ?>" alt="Image" style="max-width: 100%; max-height: 100px">
                <?php endforeach; ?>
            </a>
            <div><?= date('D, d M Y H:i:s', strtotime($response[$i]['created_at'])) ?></div>
        </div>
    <?php else: ?>
        <div>
            <a href="<?= $response[$i]['account']['url'] ?>" target="_blank"
               style="color: inherit; text-decoration: inherit">
                <div style="display: flex; align-items: center; gap: 10px">
                    <img style="height: 50px; width: 50px;" src="<?= $response[$i]['account']['avatar'] ?>"
                         alt="Account Avatar">
                    <span style="display: flex; flex-direction: column; gap: 5px">
                            <bdi>
                                <strong><?= $response[$i]['account']['display_name'] ?></strong>
                            </bdi>
                            <span>@<?= $response[$i]['account']['username'] ?>@<?php
                                preg_match('/https?:\/\/([^\/]+)/', $response[$i]['account']['url'], $matches);
                                echo $matches[1];
                                ?></span>
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
    <?php endif; ?>
<?php endfor; ?>
</body>
</html>
