<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class BoardRolesWidget extends BaseWidget
{
	public function table(Table $table) : Table
	{
		return $table
			->query(
				User::query()->where('role', 'board')
			)
			->columns([
				TextColumn::make('id')
				          ->label('ID'),
				TextColumn::make('name')
				          ->label('Name')
				          ->sortable()
				          ->searchable(),
				TextColumn::make('board_member_role')
				          ->label('Role')
				          ->formatStateUsing(fn(string $state) : string => match ($state) {
					          'president' => 'Current President',
					          'vice_president' => 'Current Vice President',
					          'general_secretary' => 'Current General Secretary',
					          'joint_secretary' => 'Current Joint Secretary',
					          'treasurer' => 'Current Treasurer',
					          'executive_committee' => 'Executive Committee Member',
					          'former_president' => 'Former President',
					          'former_general_secretary' => 'Former General Secretary',
					          'former_vice_president' => 'Former Vice President',
					          default => ucfirst($state)
				          })// Capitalize unknown roles
				          ->sortable()
				          ->searchable(),
			])
			->defaultSort('board_member_role', 'asc')
			->defaultPaginationPageOption(5)// Default 5 records per page
			->paginationPageOptions([5, 10, 25, 50, 100]); // Options for pagination dropdown
		
	}
}
