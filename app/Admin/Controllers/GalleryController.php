<?php

namespace App\Admin\Controllers;

use App\Gallery;
use App\GalleryDetails;
use App\Http\Controllers\Controller;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Illuminate\Http\Request;
use Encore\Admin\Layout\Content;

class GalleryController extends Controller
{
    protected $model = Gallery::class;

    public function index(Content $content)
    {
        $grid = new Grid(new $this->model);
        $grid->model()->orderBy('id', 'DESC');

        $grid->column('id', 'ID')->sortable();
        $grid->column('title', 'Title');
//        $grid->column('description', 'Description');
        $grid->column('created_at', trans('admin.created_at'));
        $grid->column('updated_at', trans('admin.updated_at'));

        $grid->actions(function (Grid\Displayers\Actions $actions) {
//            $actions->disableView();
            $actions->disableEdit();
        });

        return $content
            ->title('Galleries')
            ->description('List')
            ->body($grid);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Content
     */
    public function create(Content $content)
    {
        return $content
            ->title('New gallery')
            ->description('Create')
            ->body($this->form());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Gallery  $id
     * @return Content
     */
    public function edit($id, Content $content)
    {
        return $content
            ->title('Gallery')
            ->description('Edit')
            ->body($this->editForm()->edit($id));
    }

    /**
     * Show interface.
     *
     * @param mixed   $id
     * @param Content $content
     *
     * @return Content
     */
    public function show($id, Content $content)
    {
        $item = $this->model::findOrFail($id);
        $item->photos = \App\GalleryDetails::where(['gallery_id' => $item->id])->get();

        return $content
            ->title($item->title)
            ->description(' ')
            ->row($item->description)
            ->row(view('adm.gallery.show', ['photos' => $item->photos]));
    }

    public function form()
    {
        $form = new Form(new $this->model);

        $form->display('id', 'ID');
        $form->text('title', 'Title')->rules('required');
        $form->textarea('description', 'Description');
        $form->multipleImage('photos', 'Gallery photos');
        $form->display('created_at', trans('admin.created_at'));
        $form->display('updated_at', trans('admin.updated_at'));

        $form->footer(function ($footer) {
            $footer->disableReset();
            $footer->disableViewCheck();
            $footer->disableEditingCheck();
            $footer->disableCreatingCheck();
        });

        return $form;
    }

    public function editForm()
    {
        $form = new Form(new $this->model);

        $form->display('id', 'ID');
        $form->text('title', 'Title')->rules('required');
        $form->textarea('description', 'Description');
        $form->display('created_at', trans('admin.created_at'));
        $form->display('updated_at', trans('admin.updated_at'));

        $form->footer(function ($footer) {
            $footer->disableReset();
            $footer->disableViewCheck();
            $footer->disableEditingCheck();
            $footer->disableCreatingCheck();
        });

        $form->saving(function (Form $form) {

        });

        return $form;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'photos' => 'required',
        ]);

        $allowedExtension = ['jpg','png', 'jpeg'];

        if($request->hasFile('photos'))
        {
            $item = Gallery::create($request->all());

            foreach ($request->photos as $photo) {
                $filename = $photo->store('photos');
                $extension = $photo->getClientOriginalExtension();

                if( in_array($extension, $allowedExtension) ) {
                    GalleryDetails::create([
                        'gallery_id' => $item->id,
                        'filename' => $filename
                    ]);

                    admin_toastr('Upload Successfully');
                } else {

                    $extensions = implode(', ', $allowedExtension);
                    admin_info('Only ' . $extensions . ' files can be upload');
                }
            }
        }

        $route = config('admin.route.prefix') . '.admin.gallery';

        return redirect()->route($route);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Gallery  $post
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Gallery $item)
    {
//        $item->title = $request->title;
//        $item->description = $request->description;
//        $item->save();
//
//        admin_toastr('Gallery saved');
//
//        $route = config('admin.route.prefix') . '.admin.gallery';
//        return redirect()->route($route);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Gallery  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gallery $item)
    {
        $item->delete();

        $route = config('admin.route.prefix') . '.admin.gallery';

        return redirect()->route($route);
    }
}
