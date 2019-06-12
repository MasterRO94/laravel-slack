<?php

namespace App\RequestBody\Multipart;

/**
 * Multipart form-data body for uploading files
 *
 * Class FileItem
 *
 * @package App\RequestBody
 */
class FileItem
{
    /**
     * @var string
     */
    private $fileName;

    /**
     * @var string
     */
    private $filePath;

    /**
     * @var string
     */
    private $fileType;

    /**
     * @var string
     */
    private $initialComment;

    /**
     * @var string
     */
    private $channels;

    /**
     * @param string $fileName
     *
     * @return FileItem
     */
    public function setFileName(string $fileName): self
    {
        $this->fileName = $fileName;

        return $this;
    }

    /**
     * @param string $filePath
     *
     * @return FileItem
     */
    public function setFilePath(string $filePath): self
    {
        $this->filePath = $filePath;

        return $this;
    }

    /**
     * @param string $fileType
     *
     * @return FileItem
     */
    public function setFileType(string $fileType): self
    {
        $this->fileType = $fileType;

        return $this;
    }

    /**
     * @param string $initialComment
     *
     * @return FileItem
     */
    public function setInitialComment(string $initialComment): self
    {
        $this->initialComment = $initialComment;

        return $this;
    }

    /**
     * @param string $channels
     *
     * @return FileItem
     */
    public function setChannels(string $channels): self
    {
        $this->channels = $channels;

        return $this;
    }

    /**
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            [
                'name'     => 'channels',
                'contents' => $this->channels,
            ],
            [
                'name'     => 'filename',
                'contents' => $this->fileName,
            ],
            [
                'name'     => 'file',
                'contents' => fopen($this->filePath, 'rb'),
            ],
            [
                'name'     => 'filetype',
                'contents' => $this->fileType,
            ],
            [
                'name'     => 'initial_comment',
                'contents' => $this->initialComment,
            ],
        ];
    }
}
