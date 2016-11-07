#Controlled List plugin
A Kirby CMS plugin.

The standard **Checkboxes**, **Select** and **Radio** fields offer the following methods to specify the options list:

  - manually in blueprint
  - filenames and related pages
  - queries
  - options from another field
  - JSON API

With the JSON API being the most customizable. However, Kirby doesn't let you specify a "local url" for the API, you can use it only for "remote" fetches. 

The fields registered in this plugin have only one method: a user specified function. 

##Installation
Copy the repository folder to `site/plugins/controlledlist`.

##Tutorial
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

##Available fields

 - controlledcheckboxes
 - controlledselect
 - controlledradio