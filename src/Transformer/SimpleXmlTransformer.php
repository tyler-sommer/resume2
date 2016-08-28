<?php

namespace TylerSommer\Resume\Transformer;

use TylerSommer\Resume\Model\Position;
use TylerSommer\Resume\Model\Qualification;
use TylerSommer\Resume\Model\Resume;

class SimpleXmlTransformer
{
    /**
     * @param string $filename
     *
     * @return Resume
     */
    public function transformFile($filename)
    {
        $model = new Resume();

        $data = simplexml_load_file($filename);

        $model->name = (string) $data->name;
        $model->phone = (string) $data->phone;
        $model->email = (string) $data->email;

        $model->title = (string) $data->title;
        $model->description = (string) $data->description;

        foreach ($data->profile->section as $section) {
            $model->profile[] = (string) $section;
        }

        foreach ($data->experience->position as $datum) {
            $position = new Position();
            $position->company = (string) $datum->company;
            $position->title = (string) $datum->title;
            $position->location = (string) $datum->location;
            $position->from = (string) $datum->from;
            $position->to = (string) $datum->to;
            foreach ($datum->description->section as $section) {
                $position->description[] = (string) $section;
            }

            $model->experience[] = $position;
        }

        foreach ($data->experience->extra as $section) {
            $model->extra[] = (string) $section;
        }

        foreach ($data->qualifications->attribute as $datum) {
            $quality = new Qualification();
            $quality->name = (string) $datum;
            $quality->type = (string) $datum->attributes()->type;

            $model->qualifications[] = $quality;
        }

        return $model;
    }
}
