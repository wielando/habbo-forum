# Habbo-Forum
Habbo-Forum ist ein PHP geschriebenes Projekt wo du deine eigene Forum Community
aufbauen kannst. Es ist ideal geeignet für einen Wartungsmodus oder eine Fanseite.

## Warum dieses Projekt?
Das Habbo-Forum wurde bereits 2016 entwickelt und diente als Wartungsseite. Auch wenn
Foren mittlerweile als fast ausgestorben gelten, wollte ich dieses alte Projekt 
refactoren. Es dient rein als Lernprojekt und wurde dazu entwickelt neue Sachen 
kennenzulernen, jedoch auch meinen aktuellen Kenntnisstand angemessen zu repräsentieren.

## Aktueller Stand des Projekts
Das Habbo-Forum befindet sich noch in der Entwicklung. Es fehlen noch einige und wichtige
Funktionalitäten die das Foren-Erlebnis sowohl für den Nutzer als auch für moderative 
Zwecke angenehmer gestaltet. 

### To-Do Liste
- Registration & Login
- Rechte (Thread schließen, öffnen, Nutzer sperren, Beitrag löschen etc.)
- Thread erstellen und Meta-Informationen ausfüllen (wie zB. Thread-Type)
- Textformatierung im eigenen Editor
- Nutzerstatistiken

Die To-Do Liste könnte unvollständig sein!

## Nutzung
Installiere das Projekt und führe ``composer install`` aus, um die Abhängigkeiten
wie zB. Twig herunterzuladen. Konfiguriere dein Projekt unter ``app\lib\Config\Config.php``.

### Route hinzufügen
Mit folgenden Befehl kannst du eine POST-Route hinzufügen:

```php
$route->addRoute('POST', ['url' => '/YOURURL'], function(){
    //CALLBACK
});
```

Als dritter Parameter wird **optional** eine Funktion erwartet, die als Callback dient.

### Route hinzufügen mit Twig Template als Callback
Folgendes Beispiel zeigt eine POST-Route die als Callback ein Twig Template lädt

```php 
$route->addRoute('GET', ['url' => '/example'], function() {
    echo (new TemplateHandler('overview', '/example/info'))->renderTemplate(['name' => 'Wieland']);
});
```

### TemplateHandler 
Mit dem TemplateHandler ist es möglich sowohl neue Seiten als auch einzelne HTML-Stücke über
Twig zu rendern.

Beispiel:
```php 
echo (new TemplateHandler('overview', '/example/info'))->renderTemplate(['name' => 'Wieland']);
```
Der ``constructor`` der Klasse ``TemplateHandler`` erwartet zwei Paramter des Typs String. 
Der erste Parameter muss den Namen der aufzurufenden Datei beinhaltet. Der zweite Parameter beinhaltet
den Dateipfad der aufrufenden. 

Die Methode ``renderTemplate`` rendert die Eingaben und nimmt als **optionalen** Parameter
ein Array entgegen, die dem Twig Template angefügt werden.

Du kannst auch einzelne Elemente einer Twig Seite displayen. Nutze hier für die Methode
``displayTemplate()``. Beispiel:

```php
echo (new TemplateHandler('thread', '/forum'))->displayTemplate([]);
```
