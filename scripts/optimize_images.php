<?php

function optimizeImage($sourcePath, $maxWidth = 1920, $maxHeight = 1080, $quality = 80) {
    // Get image info
    $imageInfo = getimagesize($sourcePath);
    if ($imageInfo === false) {
        return false;
    }

    // Create image from source
    switch ($imageInfo[2]) {
        case IMAGETYPE_JPEG:
            $source = imagecreatefromjpeg($sourcePath);
            break;
        default:
            return false;
    }

    // Calculate new dimensions
    $width = $imageInfo[0];
    $height = $imageInfo[1];
    $ratio = $width / $height;

    if ($width > $maxWidth) {
        $width = $maxWidth;
        $height = $width / $ratio;
    }

    if ($height > $maxHeight) {
        $height = $maxHeight;
        $width = $height * $ratio;
    }

    // Create new image
    $newImage = imagecreatetruecolor($width, $height);
    imagecopyresampled($newImage, $source, 0, 0, 0, 0, $width, $height, $imageInfo[0], $imageInfo[1]);

    // Save optimized image
    imagejpeg($newImage, $sourcePath, $quality);

    // Free memory
    imagedestroy($source);
    imagedestroy($newImage);

    return true;
}

// Directory containing the images
$directory = __DIR__ . '/../storage/app/public/rooms/';

// Images to optimize
$images = [
    'luxury-ocean-suite.jpg',
    'executive-suite.jpg',
    'family-suite.jpg',
    'deluxe-studio.jpg',
    'premium-ocean-suite.jpg',
    'garden-suite.jpg'
];

// Process each image
foreach ($images as $image) {
    $imagePath = $directory . $image;
    if (file_exists($imagePath)) {
        echo "Optimizing {$image}... ";
        if (optimizeImage($imagePath)) {
            echo "Done!\n";
        } else {
            echo "Failed!\n";
        }
    } else {
        echo "{$image} not found!\n";
    }
}

echo "\nOptimization complete!\n"; 