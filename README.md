# GarchiCMS PHP SDK

The **GarchiCMS PHP SDK** is a PHP package for interacting with the **Garchi CMS API**. It provides a simple, modular, and intuitive interface for managing **categories, data items, reviews, reactions, spaces, and headless CMS features**.

📖 **API Documentation**: [Garchi CMS API Docs](https://garchi.co.uk/docs/v2)

---

## 📖 Table of Contents

- [GarchiCMS PHP SDK](#garchicms-php-sdk)
  - [📖 Table of Contents](#-table-of-contents)
  - [**Features**](#features)
  - [**Installation**](#installation)
    - [**Using Composer**](#using-composer)
  - [Usage](#usage)
    - [Initializing the SDK](#initializing-the-sdk)
    - [Module Mapping](#module-mapping)
  - [Example Usages](#example-usages)
    - [Data Item API](#data-item-api)
      - [Create a Data Item](#create-a-data-item)
      - [Get All Items](#get-all-items)
    - [Category API](#category-api)
      - [Create a Category](#create-a-category)
      - [Get All Categories](#get-all-categories)
    - [Review API](#review-api)
      - [Create a Review](#create-a-review)
    - [Reaction API](#reaction-api)
      - [Add or Update Reaction](#add-or-update-reaction)
    - [Space API](#space-api)
      - [Create a Space](#create-a-space)
    - [Compound Query API](#compound-query-api)
      - [Perform a Compound Query](#perform-a-compound-query)
    - [Headless CMS API](#headless-cms-api)
      - [Get a Page](#get-a-page)
  - [Error Handling](#error-handling)
  - [Types and Interfaces](#types-and-interfaces)
  - [Contributing](#contributing)
  - [License](#license)

---

## **Features**
- ✅ Manage **Data Items**: Create, update, delete, and fetch data items.  
- ✅ Handle **Categories**: Create, update, delete, and list categories.  
- ✅ Manage **Spaces**: Create, update, and fetch spaces.  
- ✅ Handle **Reviews**: Create, update, delete, and fetch reviews.  
- ✅ Manage **Reactions**: Add or remove reactions for items or reviews.  
- ✅ Perform **Compound Queries**: Execute complex queries across items, categories, and reviews.  
- ✅ Work with **Headless CMS**: Manage assets, pages, and section templates.

---

## **Installation**

### **Using Composer**
```sh
composer require garchicms/garchi-php-sdk
```

## Usage

This SDK is a wrapper around the [Garchi CMS API](https://garchi.co.uk/docs/v2), providing easy-to-use modular functions that map directly to API endpoints.

### Initializing the SDK
Once installed, you can use the SDK without manually requiring files, thanks to Composer's autoloading.


```php
use GarchiCMS\GarchiCMS;

$garchi = new GarchiCMS("YOUR_API_KEY");
```

### Module Mapping

Each module corresponds to a specific API group:

- `$garchi->dataItem` → Data Item API
  - `$garchi->dataItem->create()` corresponds to [Create data item API](https://garchi.co.uk/docs/v2#item-POSTapi-v2-item)
  - `$garchi->dataItem->update()` corresponds to [Update data item API](https://garchi.co.uk/docs/v2#item-POSTapi-v2-update-item)
  - `$garchi->dataItem->delete()` corresponds to [Delete data item API](https://garchi.co.uk/docs/v2#item-POSTapi-v2-delete-item)
  - `$garchi->dataItem->createMetaInfo()` corresponds to [Create meta info for item API](https://garchi.co.uk/docs/v2#item-POSTapi-v2-item_meta)
  - `$garchi->dataItem->deleteMetaInfo()` corresponds to [Delete meta info for item API](https://garchi.co.uk/docs/v2#item-POSTapi-v2-delete-item_meta)
  - `$garchi->dataItem->updateMetaInfo()` corresponds to [Update meta info for item API](https://garchi.co.uk/docs/v2#item-POSTapi-v2-update-item_meta)
  - `$garchi->dataItem->getBySpace()` corresponds to [Get items by space API](https://garchi.co.uk/docs/v2#item-GETapi-v2-space--uid--items)
  - `$garchi->dataItem->semanticSearch()` corresponds to [Semantic item search API](https://garchi.co.uk/docs/v2#item-GETapi-v2-items-semantic-search)
  - `$garchi->dataItem->featured()` corresponds to [Get featured items API](https://garchi.co.uk/docs/v2#item-GETapi-v2-items-featured)
  - `$garchi->dataItem->get()` corresponds to [Get data item API](https://garchi.co.uk/docs/v2#item-GETapi-v2-item--item-)
  - `$garchi->dataItem->getAll()` corresponds to [Get all data items API](https://garchi.co.uk/docs/v2#item-GETapi-v2-items)
  - `$garchi->dataItem->filter()` corresponds to [Filter data items API](https://garchi.co.uk/docs/v2#item-POSTapi-v2-items-filter)
  - `$garchi->dataItem->filterByMeta()` corresponds to [Filter data items by meta information API](https://garchi.co.uk/docs/v2#item-POSTapi-v2-items-filter-bymeta)
  - `$garchi->dataItem->getByIds()` corresponds to [Get data items by IDs API](https://garchi.co.uk/docs/v2#item-POSTapi-v2-items-byids) 

- `$garchi->category` → Category API
  - `$garchi->category->create()` corresponds to [Create category API](https://garchi.co.uk/docs/v2#category-POSTapi-v2-category)
  - `$garchi->category->update()` corresponds to [Update category API](https://garchi.co.uk/docs/v2#category-POSTapi-v2-update-category--category_id-)
  - `$garchi->category->delete()` corresponds to [Delete category API](https://garchi.co.uk/docs/v2#category-POSTapi-v2-delete-category--space_uid---category_id-)
  - `$garchi->category->getAll()` corresponds to [Get all categories API](https://garchi.co.uk/docs/v2#category-GETapi-v2-categories)

- `$garchi->space` → Space API
  - `$garchi->space->create()` corresponds to [Create a space API](https://garchi.co.uk/docs/v2#spaces-POSTapi-v2-space)
  - `$garchi->space->update()` corresponds to [Update a space API](https://garchi.co.uk/docs/v2#spaces-POSTapi-v2-update-space--uid-)
  - `$garchi->space->delete()` corresponds to [Delete a space API](https://garchi.co.uk/docs/v2#spaces-POSTapi-v2-delete-space--uid-)
  - `$garchi->space->getAll()` corresponds to [Get all spaces API](https://garchi.co.uk/docs/v2#spaces-GETapi-v2-spaces)
  - `$garchi->space->get()` corresponds to [Get space details API](https://garchi.co.uk/docs/v2#spaces-GETapi-v2-space--uid-)
  - `$garchi->space->categories()` corresponds to [Get categories for space API](https://garchi.co.uk/docs/v2#category-GETapi-v2-space--uid--categories)

- `$garchi->review` → Review API
  - `$garchi->review->create()` corresponds to [Create a review API](https://garchi.co.uk/docs/v2#reviews-POSTapi-v2-reviews-item)
  - `$garchi->review->update()` corresponds to [Update review API](https://garchi.co.uk/docs/v2#reviews-POSTapi-v2-reviews-edit)
  - `$garchi->review->delete()` corresponds to [Delete review API](https://garchi.co.uk/docs/v2#reviews-POSTapi-v2-reviews-delete) 
  - `$garchi->review->getByItem()` corresponds to [Get reviews for an item API](https://garchi.co.uk/docs/v2#reviews-GETapi-v2-reviews-item--item-)

- `$garchi->headless` → Headless API
  - `$garchi->headless->getAsset()` corresponds to [Get asset file for space API](https://garchi.co.uk/docs/v2#headless-web-GETapi-v2-space-assets--name-)
  - `$garchi->headless->getPage()` corresponds to [Get page content API](https://garchi.co.uk/docs/v2#headless-web-POSTapi-v2-page)
  - `$garchi->headless->createOrUpdateSectionTemplates()` corresponds to [Create or update section templates API](https://garchi.co.uk/docs/v2#headless-web-POSTapi-v2-section_template)

- `$garchi->reaction` → Reaction API
  - `$garchi->reaction->manage()` corresponds to [Reaction API](https://garchi.co.uk/docs/v2#reaction-POSTapi-v2-manage-reaction)

- `$garchi->compoundQuery` → Compound Query API
  - `$garchi->compoundQuery->query()` corresponds to [Compound query API](https://garchi.co.uk/docs/v2#compound-query-POSTapi-v2-compound_query)

Each module’s return values correspond to the return value of the respective API endpoint. The only difference is that for non-paginated API endpoints, each module’s return value can be accessed **without** the `.data` attribute.


## Example Usages

Here are some example usages

### Data Item API

#### Create a Data Item

```php
$newItem = $garchi->dataItem->create([
    'space_uid' => 'your_space_uid',
    'name' => 'New Item',
    'categories' => [1, 2, 3],
]);
```

#### Get All Items

```php
$items = $garchi->dataItem->getAll(['size' => 10]);
```

### Category API

#### Create a Category

```php
$newCategory = $garchi->category->create([
    'category' => 'New Category',
    'space_uid' => 'your_space_uid'
]);
```

#### Get All Categories

```php
$categories = $garchi->category->getAll();
```

### Review API

#### Create a Review

```php
$review = $garchi->review->create([
    'item_id' => 1,
    'rating' => 5,
    'review_body' => 'Excellent product!',
    'user_email' => 'user@example.com',
    'user_name' => 'John Doe'
]);
```

### Reaction API

#### Add or Update Reaction

```php
$reaction = $garchi->reaction->manage([
    'reaction' => 'like',
    'user_identifier' => 'user@example.com',
    'review_id' => 1,
    'item_id' => 1,
    'reaction_for' => 'review'
]);
```

### Space API

#### Create a Space

```php
$newSpace = $garchi->space->create([
    'name' => 'New Space',
    'logo' => $yourLogoFile
]);
```

### Compound Query API

#### Perform a Compound Query

```php
$queryResult = $garchi->compoundQuery->query([
    'dataset' => 'items',
    'fields' => ['name', 'price'],
    'conditions' => ['like', 'gte'],
    'values' => ['%item%', '10'],
    'logic' => ['and']
], ['order_key' => 'name', 'order_by' => 'asc']);
```

### Headless CMS API

#### Get a Page

```php
$page = $garchi->headless->getPage([
    'space_uid' => 'your_space_uid',
    'slug' => '/',
    'lang' => 'en-US',
    'mode' => 'live'
]);
```

## Error Handling

All API calls throw exceptions if the API call fails.

```php
try {
    $item = $garchi->dataItem->get(['item' => 1]);
    print_r($item);
} catch (\Exception $error) {
    echo 'Error: ' . $error->getMessage();
}
```

## Types and Interfaces

The SDK provides structured PHP classes for better type hinting and autocompletion.

```php
use GarchiCMS\Contracts\GarchiItem;
use GarchiCMS\Contracts\GarchiCategory;
use GarchiCMS\Contracts\GarchiReview;
```


## Contributing

Feel free to submit issues and pull requests to improve the SDK.

## License

This project is licensed under the MIT License.
