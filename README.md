PcbKingdee
================================

Installation
--------------------------------

```sh
composer require pcb-ems/pcb-kingdee
```

Usage
--------------------------------

1. Paginate Users

```php
use PcbEms\PcbKingdee\Client;
use PcbEms\PcbKingdee\Query\Criteria;
use PcbEms\PcbKingdee\Services\UserService;

$client = new Client($config);
$client->setCache($cache);
$client->setHttp($http);

$service = new UserService($client);
$criteria = Criteria::make()->addFilterLike('name', '昭')->forPage($page);
$result = $service->startSession('demo')->paginate($criteria);

var_dump($result->toArray());
```

2. Save the Miscellaneous

```php
use PcbEms\PcbKingdee\Flex\StockLocation;
use PcbEms\PcbKingdee\Services\MiscellaneousService;

$service = new MiscellaneousService($client);

$result = $service->startSession('demo')->save([
    'stock_direct' => $data['stock_direct'],
    'date' => date('Y-m-d H:i:s'),
    'stock_org_number' => $data['stock_org_number'],
    'owner_type_id_head' => $data['owner_type_id_head'],
    'owner_number_head' => $data['owner_number_head'],
    'note' => $data['note'],
    'entries' => array_map(function ($entry) {
        return array_merge(
            [
                'material_number' => $entry['material_number'],
                // ...
            ],
            StockLocation::parseNumberToArray($entry['stock_loc_number']),
            [
                'lot_number' => $entry['lot_number'],
                // ...
            ]
        );
    }, $data['entries']),
]);

var_dump($result->toArray());
```

3. Push the PPBom to a PickMtrl and Save

```php
use PcbEms\PcbKingdee\Models\PickMtrl;
use PcbEms\PcbKingdee\Services\PPBomService;

$service = new PPBomService($client);

$result = $service->startSession('demo')->push([
    'entry_ids' => $data['entry_ids'],
    'rule_id' => $config['rule_id'],
    'target_form_id' => PickMtrl::FORM_NAME,
    // ...
    'custom_params' => [
        'ppbom_rows' => array_map(function ($row) {
            return [
                'entry_id' => $row['entry_id'],
                // ...
                'inventories' => array_map(function ($inventory) {
                    return [
                        'material_id' => $inventory['material_id'],
                        // ...
                    ];
                }, $row['inventories']),
            ];
        }, $data['rows']),
    ],
]);

var_dump($result->toArray());
```
