<?php
$app['c.api'] = array(
    "assetsApiUrl" => "https://cdn.contentful.com/spaces/{space}/assets?access_token={token}",
    "entriesApiUrl" => "https://cdn.contentful.com/spaces/{space}/entries?access_token={token}",
    "assetApiUrl" => "https://cdn.contentful.com/spaces/{space}/assets/{asset_id}?access_token={token}",
    "entryApiUrl" => "https://cdn.contentful.com/spaces/{space}/entries/{entry_id}?access_token={token}",
);