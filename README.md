# socknnect

## installation et commande de Sass

```bash
    npm install sass --save-dev
```

### Automatisation du saas lors de chaque ctrl S

```bash
sass --watch style.scss style.css
```

### Ajouter le code suivant dans le fichier package.json pour automatiser sass :

```bash
"scripts": {
        "style:watch": "sass --watch sass/style.scss:assets/style/style.css",

    },
```
