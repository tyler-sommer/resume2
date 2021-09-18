<?php

namespace TylerSommer\Resume\Transformer;

use TylerSommer\Resume\Model\Image;
use TylerSommer\Resume\Model\Link;
use TylerSommer\Resume\Model\Position;
use TylerSommer\Resume\Model\Project;
use TylerSommer\Resume\Model\Qualification;
use TylerSommer\Resume\Model\Resume;
use TylerSommer\Resume\Model\Social;

/**
 * SimpleXmlTransformer transforms valid resume XML into PHP objects.
 */
class SimpleXmlTransformer
{
    /**
     * Transform an XML file into the logical model for the application.
     *
     * @param string $filename
     * @return Resume
     */
    public function transformFile($filename)
    {
        $model = new Resume();

        $data = simplexml_load_file($filename);

        $model->name = (string) $data->name;
        $model->phone = (string) $data->phone;
        $model->email = (string) $data->email;

        foreach ($data->title as $title) {
            $model->titles[] = (string) $title;
        }

        $model->description = (string) $data->description;

        foreach ($data->profile->section as $section) {
            $model->profile[] = (string) $section;
        }

        foreach ($data->experience->position as $datum) {
            $model->experience[] = $this->transformPosition($datum);
        }

        foreach ($data->projects->project as $datum) {
            $model->projects[] = $this->transformProject($datum);
        }

        foreach ($data->experience->extra as $section) {
            // TODO: Make use of the kind attribute?
            $model->extra[] = (string) $section;
        }

        foreach ($data->qualifications->attribute as $datum) {
            $quality = new Qualification();
            $quality->name = (string) $datum;
            $quality->type = (string) $datum->attributes()->type;
            $quality->rusty = (bool) $datum->attributes()->rusty;

            $model->qualifications[] = $quality;
        }

        foreach ($data->links->social as $datum) {
            $social = new Social();
            $social->name = (string) $datum;
            $social->icon = (string) $datum->attributes()->icon;
            $social->href = (string) $datum->attributes()->href;

            $model->social[] = $social;
        }

        return $model;
    }

    /**
     * Transforms XML representing a position into a Position model.
     *
     * @param \SimpleXMLElement $datum
     * @return Position
     */
    private function transformPosition(\SimpleXMLElement $datum) {
        $position = new Position();
        $position->company = (string) $datum->company;
        $position->title = (string) $datum->title;
        $position->location = (string) $datum->location;
        $position->from = (string) $datum->from;
        $position->to = (string) $datum->to;
        foreach ($datum->description->section as $section) {
            $position->description[] = (string) $section;
        }
        return $position;
    }

    /**
     * Transforms XML representing a project into a Project model.
     *
     * @param \SimpleXMLElement $datum
     * @return Project
     */
    private function transformProject(\SimpleXMLElement $datum) {
        $project = new Project();
        $project->name = (string) $datum->name;
        $project->blurb = (string) $datum->blurb;
        foreach ($datum->description->section as $section) {
            $project->description[] = (string) $section;
        }

        foreach ($datum->link as $rawLink) {
            $link = new Link();
            $link->href = (string) $rawLink->attributes()->href;
            $link->icon = (string) $rawLink->attributes()->icon;
            $link->text = (string) $rawLink;
            $project->links[] = $link;
        }

        foreach ($datum->image as $rawImage) {
            $image = new Image();
            $image->src = (string) $rawImage->attributes()->src;
            $image->alt = (string) $rawImage->attributes()->alt;
            $image->title = (string) $rawImage->attributes()->title;
            $image->text = (string) $rawImage;
            $project->images[] = $image;
        }

        return $project;
    }
}
