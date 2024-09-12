<?php
// Vérifier si le formulaire a été soumis
// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     // Vérifier si un fichier a été téléchargé
//     if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {

//         // Définir le répertoire où stocker les fichiers
//         $upload_dir = 'uploads/';  // Assurez-vous que ce dossier existe et est accessible en écriture

//         // Récupérer les informations du fichier
//         $file_name = basename($_FILES['photo']['name']);
//         $file_tmp_name = $_FILES['photo']['tmp_name'];
//         $file_size = $_FILES['photo']['size'];
//         $file_type = $_FILES['photo']['type'];
//         $file_error = $_FILES['photo']['error'];

//         // Obtenir l'extension du fichier
//         $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

//         // Extensions autorisées
//         $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];

//         // Vérifier l'extension du fichier
//         if (in_array($file_ext, $allowed_extensions)) {
//             // Vérifier la taille du fichier (5 Mo maximum)
//             if ($file_size <= 5000000) {
//                 // Définir un nouveau nom pour éviter les conflits
//                 $new_file_name = uniqid() . '.' . $file_ext;

//                 // Chemin complet où enregistrer l'image
//                 $upload_file = $upload_dir . $new_file_name;

//                 // Déplacer le fichier téléchargé vers le répertoire final
//                 if (move_uploaded_file($file_tmp_name, $upload_file)) {
//                     echo "Le fichier a été téléchargé avec succès : <a href='$upload_file'>$new_file_name</a>";
//                 } else {
//                     echo "Erreur lors de l'upload du fichier.";
//                 }
//             } else {
//                 echo "Le fichier est trop volumineux. Taille maximum autorisée : 5 Mo.";
//             }
//         } else {
//             echo "Seules les extensions JPG, JPEG, PNG et GIF sont autorisées.";
//         }
//     } else {
//         echo "Aucun fichier téléchargé ou une erreur s'est produite.";
//     }
// }
?>