<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 *
 * Extend this class in any new controllers:
 * ```
 *     class Home extends BaseController
 * ```
 *
 * For security, be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */

    // protected $session;
    protected $helpers = ['url', 'form', 'text', 'auth'];
    /**
     * @return void
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Load here all helpers you want to be available in your controllers that extend BaseController.
        // Caution: Do not put the this below the parent::initController() call below.
        // $this->helpers = ['form', 'url'];

        // Caution: Do not edit this line.
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.
        // $this->session = service('session');
    }
    protected function saveWithImage(
        $model,
        array $data,
        $file,
        string $uploadPath,
        string $imgField = 'img',
        callable $insertCallback = null
    ) {
        $finfo = new \finfo(FILEINFO_MIME_TYPE);
        $mimeType = $finfo->file($file->getTempName());
        $allowedMimes = ['image/jpeg', 'image/png', 'image/webp'];

        if (!in_array($mimeType, $allowedMimes)) {
            return ['success' => false, 'error' => 'File bukan gambar yang valid!'];
        }

        $newName = $file->getRandomName();
        $fullPath = rtrim($uploadPath, '/') . '/' . $newName;

        try {
            $file->move($uploadPath, $newName);
        } catch (\Exception $e) {
            return ['success' => false, 'error' => 'Gagal upload: ' . $e->getMessage()];
        }

        $data[$imgField] = $newName;

        try {
            if ($insertCallback) {
            $inserted = $insertCallback($model, $data);
        } else {
            $inserted = $model->insert($data);
        }

            if (!$inserted) {
                if (file_exists($fullPath)) unlink($fullPath);

                $modelErrors = $model->errors();
                $dbError = $model->db->error();

                $msg = 'Gagal menyimpan data.';
                if (!empty($modelErrors)) $msg .= ' ' . implode(', ', $modelErrors);
                if (!empty($dbError['message'])) $msg .= ' ' . $dbError['message'];

                return ['success' => false, 'error' => $msg];
            }
        } catch (\Exception $e) {
            if (file_exists($fullPath)) unlink($fullPath);
            return ['success' => false, 'error' => 'Gagal simpan: ' . $e->getMessage()];
        }

        return ['success' => true, 'file' => $newName];
    }

    protected function updateWithImage(
    $model,
    $id,
    array $data,
    $file,
    string $uploadPath,
    string $imgField = 'img',
    string $oldImageValue = null,
    callable $updateCallback = null
) {
    $newImageName = null;
    $fullNewPath = null;
    if ($file && $file->isValid() && !$file->hasMoved()) {
        
        $finfo = new \finfo(FILEINFO_MIME_TYPE);
        $mimeType = $finfo->file($file->getTempName());
        $allowedMimes = ['image/jpeg', 'image/png', 'image/webp'];

        if (!in_array($mimeType, $allowedMimes)) {
            return ['success' => false, 'error' => 'File bukan gambar yang valid!'];
        }

        $newImageName = $file->getRandomName();
        $fullNewPath = rtrim($uploadPath, '/') . '/' . $newImageName;

        try {
            $file->move($uploadPath, $newImageName);
        } catch (\Exception $e) {
            return ['success' => false, 'error' => 'Gagal upload: ' . $e->getMessage()];
        }

        $data[$imgField] = $newImageName;
    }
    try {
        $updated = null;
        if ($updateCallback) {
            $updated = $updateCallback($model, $id, $data);
        } else {
            $updated = $model->update($id, $data);
        }

        if (!$updated) {
            if ($fullNewPath && file_exists($fullNewPath)) {
                unlink($fullNewPath);
            }
            return ['success' => false, 'error' => 'Gagal memperbarui data.'];
        }
    } catch (\Exception $e) {
        if ($fullNewPath && file_exists($fullNewPath)) {
            unlink($fullNewPath);
        }
        return ['success' => false, 'error' => 'Gagal update: ' . $e->getMessage()];
    }


    if ($newImageName && $oldImageValue) {
        $fullOldPath = rtrim($uploadPath, '/') . '/' . $oldImageValue;
        if (file_exists($fullOldPath)) {
            unlink($fullOldPath);
        }
    }

    return ['success' => true, 'file' => $newImageName];
}

protected function saveSimple($model, array $data, callable $insertCallback = null)
{
    try {
        if ($insertCallback) {
            $inserted = $insertCallback($model, $data);
        } else {
            $inserted = $model->insert($data);
        }

        if (!$inserted) {
            $modelErrors = $model->errors();
            $dbError = $model->db->error();

            $msg = 'Gagal menyimpan data.';
            if (!empty($modelErrors)) $msg .= ' ' . implode(', ', $modelErrors);
            if (!empty($dbError['message'])) $msg .= ' ' . $dbError['message'];

            log_message('error', 'Save failed: ' . $msg);
            return ['success' => false, 'error' => $msg];
        }

        return ['success' => true];
    } catch (\Exception $e) {
        log_message('error', 'Save exception: ' . $e->getMessage());
        return ['success' => false, 'error' => 'Gagal menyimpan: ' . $e->getMessage()];
    }
}

protected function updateSimple($model, $id, array $data, callable $updateCallback = null)
{
    try {
        if ($updateCallback) {
            $updated = $updateCallback($model, $id, $data);
        } else {
            $updated = $model->update($id,$data);
        }

        if (!$updated) {
            $modelErrors = $model->errors();
            $dbError = $model->db->error();

            $msg = 'Gagal memperbarui data.';
            if (!empty($modelErrors)) $msg .= ' ' . implode(', ', $modelErrors);
            if (!empty($dbError['message'])) $msg .= ' ' . $dbError['message'];

            log_message('error', 'Update failed: ' . $msg);
            return ['success' => false, 'error' => $msg];
        }

        return ['success' => true];
    } catch (\Exception $e) {
        log_message('error', 'Update exception: ' . $e->getMessage());
        return ['success' => false, 'error' => 'Gagal update: ' . $e->getMessage()];
    }
}
}
