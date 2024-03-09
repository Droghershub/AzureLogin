<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Role;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('photo')->nullable();
            $table->string('email')->nullable()->unique();
            $table->string('phone')->nullable()->unique();
            $table->string('guest')->nullable()->unique();
            $table->string('password')->nullable();
            $table->integer('points')->default(0);
            $table->enum('status', ['ACTIVE', 'INACTIVE', 'BANNED'])->default('ACTIVE');
            $table->timestamps();
            $table->softDeletes();
        });

        $arr = [
            'admin',
            'accountant',
            'staff',
            'customer'
        ];

        foreach ($arr as $item) {
            Role::create([
                'name' => $item
            ]);
        }
        
        $user = User::create([
            'name' => 'Ravindra M',
            'email' => 'balajiravindra2512@yahoo.co.in',
            'phone' => '9008422424',
            'password' => 'vZX5bN-Y2CTWi-N9x9Me'
        ]);
        
        $user->assignRole('admin');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
