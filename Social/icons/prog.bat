echo off



ffmpeg -i large/facebook_black.png -vf scale=200:-1 redim/facebook_black.webp
ffmpeg -i large/facebook_white.png -vf scale=200:-1 redim/facebook_white.webp
ffmpeg -i large/github_black.png -vf scale=200:-1 redim/github_black.webp
ffmpeg -i large/github_white.png -vf scale=200:-1 redim/github_white.webp
ffmpeg -i large/instagram_black.png -vf scale=200:-1 redim/instagram_black.webp
ffmpeg -i large/instagram_white.png -vf scale=200:-1 redim/instagram_white.webp
ffmpeg -i large/mail_black.png -vf scale=200:-1 redim/mail_black.webp
ffmpeg -i large/mail_white.png -vf scale=200:-1 redim/mail_white.webp
ffmpeg -i large/twitter_black.png -vf scale=200:-1 redim/twitter_black.webp
ffmpeg -i large/twitter_white.png -vf scale=200:-1 redim/twitter_white.webp
ffmpeg -i large/whatsapp_black.png -vf scale=200:-1 redim/whatsapp_black.webp
ffmpeg -i large/whatsapp_white.png -vf scale=200:-1 redim/whatsapp_white.webp
ffmpeg -i large/www_black.png -vf scale=200:-1 redim/www_black.webp
ffmpeg -i large/www_white.png -vf scale=200:-1 redim/www_white.webp
ffmpeg -i large/youtube_black.png -vf scale=200:-1 redim/youtube_black.webp
ffmpeg -i large/youtube_white.png -vf scale=200:-1 redim/youtube_white.webp

echo on