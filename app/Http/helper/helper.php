<?php
use App\Models\User;
use App\Models\System;

function upload($file){
        $filename = md5($file->getClientOriginalName())."_".time().'.'.$file->getClientOriginalExtension();
        $file->storeAs('public/files',$filename);
        return $filename;
}
function username($id){
  return User::find($id)->value('username');
}
function SystemName($id){
  return System::where('id',$id)->get('name')->value('name') ;
}
function fileTypeIcon($name){
    $name = match (strtolower($name)) {
        'pdf'               => 'fa-file-pdf',
        'doc', 'docx'       => 'fa-file-word',
        'xls', 'xlsx', 'csv'=> 'fa-file-excel',
        'txt', 'rtf'        => 'fa-file-lines',
        'mp3', 'wav', 'aac' => 'fa-file-audio',
        'mp4', 'avi', 'mov', 'mkv', 'webm' => 'fa-file-video',
        'epub'              => 'fa-book',
        'zip', 'rar'        => 'fa-file-zipper',
        'jpg', 'jpeg', 'png', 'gif', 'svg' => 'fa-file-image',
        default             => 'fa-file',
    };
    return $name;
}
function StorageUsed($resources){
  if ($resources->count() == 0) return 0;
  $size = 0;
  foreach ($resources as $resource) {
    $size += filesize(storage_path('app/public/files/'.$resource->filename))/1048576;
  }
  return $size;
}
function ArcCode() {
    do {
        $digits = str_pad(mt_rand(0, 9999), 4, '0', STR_PAD_LEFT) .
                  str_pad(mt_rand(0, 9999), 4, '0', STR_PAD_LEFT);

        $formatted = substr($digits, 0, 4) . '-' . substr($digits, 4, 4);
        $code = 'ARC-' . $formatted;

    } while (\App\Models\Ticket::where('token', $code)->exists());

    return $code;
}
function highlightWord($text, $word) {
    // Escape special characters for regex
    $escapedWord = preg_quote($word, '/');

    // Replace the word with a highlighted span (case-insensitive, whole word match)
    $highlightedText = preg_replace(
        "/\b($escapedWord)\b/i",
        '<span style="background-color: #a8f0b4; color: black;">$1</span>',
        $text
    );

    return $highlightedText;
}

    function clean_html_limit($html, $limit = 300)
    {
        // Strip completely if empty or not HTML at all
        if (! $html) {
            return '';
        }

        // Use PHP's DOMDocument to ensure well-formedness
        $dom = new DOMDocument();

        // Suppress errors due to bad HTML (libxml_use_internal_errors)
        libxml_use_internal_errors(true);
        $dom->loadHTML(mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8'));
        libxml_clear_errors();

        // Extract body content only (ignore <html><head> wrapper)
        $body = $dom->getElementsByTagName('body')->item(0);
        $htmlContent = '';
        foreach ($body->childNodes as $node) {
            $htmlContent .= $dom->saveHTML($node);
        }

        // Remove tags if you want *only text* (optional)
        // $htmlContent = strip_tags($htmlContent);

        // Now truncate *text* but keep tags balanced
        $total = 0;
        $result = '';
        $openTags = [];

        $tokens = preg_split('/(<[^>]+>)/u', $htmlContent, -1, PREG_SPLIT_DELIM_CAPTURE);
        foreach ($tokens as $token) {
            if (trim($token) === '') {
                continue;
            }

            if ($token[0] === '<') {
                // Handle tags
                if (preg_match('/^<\s*\/(\w+)/', $token, $matches)) {
                    // Closing tag
                    $tag = strtolower($matches[1]);
                    $pos = array_search($tag, array_reverse($openTags, true));
                    if ($pos !== false) {
                        unset($openTags[$pos]);
                        $openTags = array_values($openTags);
                    }
                } elseif (!preg_match('/\/>$/', $token)) {
                    // Opening tag (not self closing)
                    if (preg_match('/^<\s*(\w+)/', $token, $matches)) {
                        $openTags[] = strtolower($matches[1]);
                    }
                }
                $result .= $token;
            } else {
                // Handle text content
                $remaining = $limit - $total;
                $length = mb_strlen($token);

                if ($length <= $remaining) {
                    $result .= $token;
                    $total += $length;
                } else {
                    $result .= mb_substr($token, 0, $remaining);
                    $total += $remaining;
                    break;
                }
            }

            if ($total >= $limit) {
                break;
            }
        }

        // Close any still-open tags
        foreach (array_reverse($openTags) as $tag) {
            $result .= "</{$tag}>";
        }

        return trim($result);
  }
