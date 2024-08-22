<?php

namespace Class;

//Import Interface 
use Interface\ContentInterface;

class Comment implements ContentInterface
{
	protected $id, $body, $createdAt, $newsId;

	public function setId($id)
	{
		$this->id = $id;
		return $this;
	}

	public function getId()
	{
		return $this->id;
	}

	public function setBody($body)
	{
		$this->body = $body;
		return $this;
	}

	public function getBody()
	{
		return $this->body;
	}

	public function setCreatedAt($createdAt)
	{
		$this->createdAt = $createdAt;
		return $this;
	}

	public function getCreatedAt()
	{
		return $this->createdAt;
	}

	public function setNewsId($newsId)
	{
		$this->newsId = $newsId;
		return $this;
	}

	public function getNewsId()
	{
		return $this->newsId;
	}
}