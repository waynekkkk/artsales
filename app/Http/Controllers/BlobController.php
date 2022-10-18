<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;

class BlobController extends Controller
{
    public function uploadFile($file)
    {
        $errors = array();
        
        $name = $file->getClientOriginalName();
        $tmp_name = $file;

        $ext = pathinfo(strtolower($name), PATHINFO_EXTENSION);

        if (empty($errors)) {
            try {
                //check the file extension
                $filetype = $this->checkExtensionType($ext);
                $file_encoding = $this->checkExtensionEncoding($ext);
        
                if(!$filetype){
                    $errors['message'] = 'File type not supported! Please contact the administrator!';
                }
        
                if(!$file_encoding){
                    $errors['message'] = 'File encoding not supported! Please contact the administrator!';
                }
            } catch (Exception $e) {
                $errors['message'] = "An error occured while uploading the image.";
            }
        }
        
        if($errors)
        {
            return response($errors,402);
        }

        $new_name = rand(111111111, 999999999) . "." . $ext;

        try {
            $accesskey = env('AZURE_BLOB_KEY');
            $storageAccount = env('AZURE_BLOB_STORAGE_ACCOUNT');
            $filetoUpload = realpath($tmp_name);
            $containerName = 'wad2';
            $destinationURL = "https://$storageAccount.blob.core.windows.net/$containerName/$new_name";

            $this->uploadBlob($filetoUpload, $storageAccount, $containerName, $new_name, $destinationURL, $accesskey, $file_encoding);

            $upload_destination = $destinationURL;
        } catch (Exception $e) {
            $out = new \Symfony\Component\Console\Output\ConsoleOutput();
            $out->writeln($e->getMessage());
            $errors['sql'] = $e->getMessage();
            $errors['message'] = "An error occured while uploading the profile picture.";
        }

        if($errors)
        {
            return response($errors, 402);
        }
        else 
        {
            return response(['url' => $upload_destination], 200);
        }
    }

    public function uploadImage(Request $request, $field_name)
    {
        $errors = array();
        
        if ($request->hasFile($field_name)) {
            $uploadFile = $request->file($field_name);
            $name = $uploadFile->getClientOriginalName();
            $tmp_name = $uploadFile;

            $ext = pathinfo(strtolower($name), PATHINFO_EXTENSION);

            if (empty($errors)) {
                try {
                    //check the file extension
                    $filetype = $this->checkExtensionType($ext);
                    $file_encoding = $this->checkExtensionEncoding($ext);
            
                    if(!$filetype){
                        $errors['message'] = 'File type not supported! Please contact the administrator!';
                    }
            
                    if(!$file_encoding){
                        $errors['message'] = 'File encoding not supported! Please contact the administrator!';
                    }
                } catch (Exception $e) {
                    $errors['message'] = "An error occured while uploading the image.";
                }
            }
            
            if($errors)
            {
                return response($errors,402);
            }

            $new_name = rand(111111111, 999999999) . "." . $ext;

            try {
                $accesskey = env('AZURE_BLOB_KEY');
                $storageAccount = env('AZURE_BLOB_STORAGE_ACCOUNT');
                $filetoUpload = realpath($tmp_name);
                $containerName = 'wad2';
                $destinationURL = "https://$storageAccount.blob.core.windows.net/$containerName/$new_name";

                $this->uploadBlob($filetoUpload, $storageAccount, $containerName, $new_name, $destinationURL, $accesskey, $file_encoding);

                $upload_destination = $destinationURL;
            } catch (Exception $e) {
                $out = new \Symfony\Component\Console\Output\ConsoleOutput();
                $out->writeln($e->getMessage());
                $errors['sql'] = $e->getMessage();
                $errors['message'] = "An error occured while uploading the image.";
            }

            if($errors)
            {
                return response($errors, 402);
            }
            else 
            {
                return response(['url' => $upload_destination], 200);
            }
        }
    }

    public function uploadImages($file)
    {
        $errors = array();
        
        if ($file) {
            $uploadFile = $file;
            $name = $uploadFile->getClientOriginalName();
            $tmp_name = $uploadFile;

            $ext = pathinfo(strtolower($name), PATHINFO_EXTENSION);

            if (empty($errors)) {
                try {
                    //check the file extension
                    $filetype = $this->checkExtensionType($ext);
                    $file_encoding = $this->checkExtensionEncoding($ext);
            
                    if(!$filetype){
                        $errors['message'] = 'File type not supported! Please contact the administrator!';
                    }
            
                    if(!$file_encoding){
                        $errors['message'] = 'File encoding not supported! Please contact the administrator!';
                    }
                } catch (Exception $e) {
                    $errors['message'] = "An error occured while uploading the image.";
                }
            }
            
            if($errors)
            {
                return response($errors,402);
            }

            $new_name = rand(111111111, 999999999) . "." . $ext;

            try {
                $accesskey = env('AZURE_BLOB_KEY');
                $storageAccount = env('AZURE_BLOB_STORAGE_ACCOUNT');
                $filetoUpload = realpath($tmp_name);
                $containerName = 'wad2';
                $destinationURL = "https://$storageAccount.blob.core.windows.net/$containerName/$new_name";

                $this->uploadBlob($filetoUpload, $storageAccount, $containerName, $new_name, $destinationURL, $accesskey, $file_encoding);

                $upload_destination = $destinationURL;
            } catch (Exception $e) {
                $out = new \Symfony\Component\Console\Output\ConsoleOutput();
                $out->writeln($e->getMessage());
                $errors['sql'] = $e->getMessage();
                $errors['message'] = "An error occured while uploading the image.";
            }

            if($errors)
            {
                return response($errors, 402);
            }
            else 
            {
                return response(['url' => $upload_destination], 200);
            }
        }
    }

    public function uploadBlob($filetoUpload, $storageAccount, $containerName, $blobName, $destinationURL, $accesskey, $file_encoding)
    {
        $currentDate = gmdate("D, d M Y H:i:s T", time());
        $handle = fopen($filetoUpload, "r");
        $fileLen = filesize($filetoUpload);

        $headerResource = "x-ms-blob-cache-control:max-age=3600\nx-ms-blob-type:BlockBlob\nx-ms-date:$currentDate\nx-ms-version:2017-04-17";
        $urlResource = "/$storageAccount/$containerName/$blobName";

        $arraysign = array();
        $arraysign[] = 'PUT'; /*HTTP Verb*/
        $arraysign[] = ''; /*Content-Encoding*/
        $arraysign[] = ''; /*Content-Language*/
        $arraysign[] = $fileLen; /*Content-Length (include value when zero)*/
        $arraysign[] = ''; /*Content-MD5*/
        $arraysign[] = $file_encoding; /*Content-Type*/
        $arraysign[] = ''; /*Date*/
        $arraysign[] = ''; /*If-Modified-Since */
        $arraysign[] = ''; /*If-Match*/
        $arraysign[] = ''; /*If-None-Match*/
        $arraysign[] = ''; /*If-Unmodified-Since*/
        $arraysign[] = ''; /*Range*/
        $arraysign[] = $headerResource; /*CanonicalizedHeaders*/
        $arraysign[] = $urlResource; /*CanonicalizedResource*/

        $str2sign = implode("\n", $arraysign);

        $sig = base64_encode(hash_hmac('sha256', urldecode(utf8_encode($str2sign)), base64_decode($accesskey), true));
        $authHeader = "SharedKey $storageAccount:$sig";

        $headers = [
            'Authorization: ' . $authHeader,
            'x-ms-blob-cache-control: max-age=3600',
            'x-ms-blob-type: BlockBlob',
            'x-ms-date: ' . $currentDate,
            'x-ms-version: 2017-04-17',
            'Content-Type: ' . $file_encoding,
            'Content-Length: ' . $fileLen
        ];

        $ch = curl_init($destinationURL);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_INFILE, $handle);
        curl_setopt($ch, CURLOPT_INFILESIZE, $fileLen);
        curl_setopt($ch, CURLOPT_UPLOAD, true);
        $result = curl_exec($ch);
        curl_close($ch);

        fclose($handle);
        unlink($filetoUpload);
    }

    public function checkExtensionType($fileext){
        switch ($fileext)
        {
            //video
            case 'mp4':
                return 'video';
            break;
    
            case 'webm':
                return 'video';
            break;
    
            //image
            case 'jpg':
                return 'image';
            break;

            case 'jpeg':
                return 'image';
            break;
    
            case 'png':
                return 'image';
            break;
    
            case 'gif':
                return 'image';
            break;
                
            default:
                return false;
            break;
        }
    }
    
    public function checkExtensionEncoding($fileext){
        switch ($fileext)
        {
            //video
            case 'mp4':
                return 'video/mp4';
            break;
    
            case 'webm':
                return 'video/webm';
            break;
    
            //image
            case 'jpg':
                return 'image/jpeg';
            break;
    
            case 'jpeg':
                return 'image/jpeg';
            break;
    
            case 'png':
                return 'image/png';
            break;
    
            case 'gif':
                return 'image/gif';
            break;
                
            default:
                return false;
            break;
        }
    }
}
