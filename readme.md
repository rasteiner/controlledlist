# Controlled List plugin
A Kirby CMS plugin.

The standard **Checkboxes**, **Select** and **Radio** fields offer the following methods to specify the options list:

  - manually in blueprint
  - filenames and related pages
  - queries
  - options from another field
  - JSON API

With the JSON API being the most customizable. ~~However, Kirby doesn't let you specify a "local url" for the API, you can use it only for "remote" fetches.~~* 

The fields registered in this plugin have only one method: a user specified function. 

## Installation
Copy the repository folder to `site/plugins/controlledlist`.

## Tutorial
In this tutorial we will see how to use the "controlled list" plugin to  create a `checkboxes` field that lets you choose from the panel users. 

First you need to have a `callable` that gets loaded when you are in the panel. The easiest way to do this is writing a plugin, so create a folder in the plugins folder like this:

**site/plugins/myplugin/myplugin.php**:

```php
<?php

class MyPlugin {
    static function userlist($field) {
        $kirby = kirby();
        $site = $kirby->site();
        $users = $site->users();

        $result = array();

        foreach ($users as $user) {
            $result[$user->username] = 
                $user->firstName() . ' ' . $user->lastName();
        }

        return $result;
    }
}
```

Then in your blueprint create a field like this:

```yaml
fields:
    mycheckboxes:
        label: Users
        type: controlledcheckboxes
        controller: MyPlugin::userlist
```

## Available fields

 - controlledcheckboxes
 - controlledselect
 - controlledradio
 
## À propos Kirby 2.5.0 local fetches

\* Since Kirby 2.5.0 it seems like you can fetch local endpoints. However, this means it still needs to go through a cURL request from your server to your server. If you have your options data ready, it may be easier and faster to just give that to the field, instead of creating a new request. Especially if you don't intend to expose that data to the public. 

Compare:

<table>
  <tr>
    <th>Local request</th>
    <th>Controlled List</th>
  </tr>
  <tr>
    <td>
      <li>reserving memory for the request
      <li>handling the routing
      <li>checking if the request is authenticated as a panel user
      <li>doing the work to get the options
      <li>serializing to JSON
      <li>deserializing from JSON
    </td>
    <td>
      <li>doing the work to get the options    
    </td>
  </tr>
</table>
