# socknnect

## installation et commande de Sass

```bash
    npm install sass --save-dev
```

### Automatisation du sass lors de chaque sauvegarde

```bash
sass --watch style.scss style.css
```

### Ajouter le code suivant dans le fichier package.json pour automatiser sass :

```bash
"scripts": {
    "style:watch": "sass --watch sass/style.scss:assets/style/style.css"
}
```
