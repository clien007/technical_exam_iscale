<?php

namespace Interface;

interface ContentInterface
{
	public function setId($id);
	public function getId();

	public function setBody($body);
	public function getBody();

	public function setCreatedAt($createdAt);
	public function getCreatedAt();
}